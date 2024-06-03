<?php

use App\Http\Controllers\EmployeesContoller;
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

Route::get('/',[EmployeesContoller::class, 'index']);

Route::get('/people/{email}', [EmployeesContoller::class, 'show']);

Route::get('/create', [EmployeesContoller::class, 'create']);

Route::post('/people', [EmployeesContoller::class, 'store']);
