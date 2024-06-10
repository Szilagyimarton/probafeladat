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

Route::get('/loadxml',[EmployeesContoller::class, 'loadXML']);
Route::get('/people/{email}', [EmployeesContoller::class, 'show']);
Route::post('/people', [EmployeesContoller::class, 'store']);
Route::delete('/people/{email}', [EmployeesContoller::class, 'delete']);
