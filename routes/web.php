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


Route::get('/', function () { return view('Admin.index'); })->name('AdminDashboard');
Route::get('/Accounts', function () { return view('Admin.accounts'); })->name('Accounts');
Route::get('/Events', function () { return view('Admin.events'); })->name('Events');
Route::get('/Documents', function () { return view('Admin.documents'); })->name('Documents');
Route::get('/blank', function () { return view('Admin.blank'); })->name('Blank');
Route::get('/Settings', function () { return view('Admin.settings'); })->name('Settings');
Route::get('/Login', function () { return view('Admin.login'); })->name('AdminLogin');
Route::get('/Programs', function () { return view('Admin.programs'); })->name('Programs');