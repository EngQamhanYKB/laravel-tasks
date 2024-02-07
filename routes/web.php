<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Models\Task;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

Route::get('/', function () {
    //return view('default.layouts.index');
    //return redirect('https://online.yk-bank.com:8080');
    //return redirect('/telescope');

    return redirect(RouteServiceProvider::HOME);
});
