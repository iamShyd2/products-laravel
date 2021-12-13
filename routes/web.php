<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LaundryItemsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('admin/', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name("admin.index");
Route::get('manager/', [App\Http\Controllers\ManagerDashboardController::class, 'index'])->name("manager.index");
Route::get('users/accept', [UsersController::class, 'accept'])->name("users.accept");
Route::put('users/accept', [UsersController::class, 'accepted'])->name("users.accepted");
Route::resource("users", UsersController::class);
Route::get('managers', [UsersController::class, 'managers'])->name("managers.index");
Route::resource("laundry_items", LaundryItemsController::class);
Route::resource("customers", CustomersController::class);
Route::get("jobs", [JobsController::class, "index"])->name("jobs.index");
Route::get("jobs/{id}/receipt", [JobsController::class, "receipt"])->name("jobs.receipt");
Route::resource("customers.jobs", JobsController::class);
Route::resource("jobs", JobsController::class);
Route::resource("messages", MessagesController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
