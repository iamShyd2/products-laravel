<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invite;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      if(!auth()->user()->can("view users")) return response("", 401);
      $users = User::where("email", "!=" , "admin@gmail.com")->get();
      return view("users.index", ["users" => $users]);
    }

    public function show($id)
    {
      if(!auth()->user()->can("view users")) return response("", 401);
      $user = User::find($id);
      return view("users.show", ["user" => $user]);
    }

    public function create()
    {
      if(!auth()->user()->can("store users")) return response("", 401);
      $branches = Branch::all();
      return view("users.create", ["branches" => $branches]);
    }

    public function edit($id)
    {
      if(!auth()->user()->can("update users")) return response("", 401);
      $user = User::find($id);
      return view("users.edit", ["user" => $user]);
    }

    protected function store(Request $request)
    {
      if(!auth()->user()->can("store users")) return response("", 401);
      $request->validate([
         'email' => 'required|unique:users',
         "role" => "required|in:Staff,Manager",
         "gender" => "required|in:Male,Female",
         "phone" => "required|unique:users",
         "address" => "required",
         "password" => "required",
         "branch_id" => "required"
      ]);
      $params = $request->input();
      $role = $params["role"];
      unset($params["role"]); // delete row because it's not a column in users
      $params["password"] = Hash::make($params["password"]);
      $user = User::create($params);
      $user->assignRole($role);
      return redirect()
        ->route("users.index")
        ->with('success', 'User invited successfully');
    }

    protected function update(Request $request, $id)
    {
      if(!auth()->user()->can("update users")) return response("", 401);
      $request->validate([
         'email' => 'required',
         "role" => "required|in:Staff,Manager",
         "gender" => "required|in:Male,Female",
         "phone" => "required",
         "address" => "required"
      ]);
      $user = User::find($id);
      $params = $request->input();
      $role = $params["role"];
      unset($params["role"]); // delete row because it's not a column in users
      $user->update($params);
      $user->roles()->delete();
      $user->assignRole($role);
      return redirect()
        ->route("users.index")
        ->with('success', 'User updated successfully');
    }

    protected function destroy($id)
    {
      if(!auth()->user()->can("destroy users")) return response("", 401);
      $user = User::find($id);
      if($user->hasRole("Super Admin")) abort("", 403);
      $user->delete();
      return redirect()
        ->route("users.index")
        ->with('success', 'User deleted successfully');
    }

}
