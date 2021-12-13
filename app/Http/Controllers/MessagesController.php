<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Message;
use App\Models\CustomerMessage;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class MessagesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  private function sendMessage($message, $recipients)
  {
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    $client->messages->create("+233 54 019 4412",
            [
              'body' => $message
            ]
          );
  }

  protected function create(Request $request)
  {
    $request->validate([
      "ids" => "required"
    ]);
    $ids = $request->query("ids");
    $customers = Customer::find($ids);
    return view("messages.create", ["customers" => $customers, "ids" => $ids]);
  }

  protected function store(Request $request)
  {

    $request->validate([
      "ids" => "required",
      "body" => "required"
    ]);
    $message = new Message;
    $message->body = $request->body;
    $message->save();
    $customers = Customer::find($request->query("ids"));
    $phones = [];
    foreach ($customers as $key => $customer) {
      CustomerMessage::create([
        "message_id" => $message->id,
        "customer_id" => $customer->id
      ]);
      $this->sendMessage($message->body, $customer->phone);
    };
    activity()
     ->performedOn($message)
     ->causedBy(auth()->user())
     ->log('sent a message');
    return redirect()
      ->route("customers.index")
      ->with("Success", "Message sent successfully");
  }

}
