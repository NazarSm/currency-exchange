<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
    //return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

/*user*/
Route::get('/currency-exchange', [App\Http\Controllers\TransactionController::class, 'formCurrencyExchange'])
    ->name('form.currency.exchange')
    ->middleware('auth');
Route::get('/send-money', [App\Http\Controllers\TransactionController::class, 'formSendMoney'])
    ->name('form.send.money')
    ->middleware('auth');
Route::patch('/transfer-money/{typeTransfer}', [App\Http\Controllers\TransactionController::class, 'transferMoney'])
    ->name('transfer.money')
    ->middleware('auth');

/*admin*/
Route::get('users', [App\Http\Controllers\AdminController::class, 'indexUsers'])
    ->name('users')
    ->middleware('admin');
Route::get('/show-user/{user_id}', [App\Http\Controllers\AdminController::class, 'showUser'])
    ->name('show.user')
    ->middleware('admin');
