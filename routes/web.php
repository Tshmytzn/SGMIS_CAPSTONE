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


Route::get('/Admin', function () { return view('admin.index'); })->name('AdminDashboard');
Route::get('/Accounts', function () { return view('admin.accounts'); })->name('Accounts');
Route::get('/Events', function () { return view('admin.events'); })->name('Events');
Route::get('/Documents', function () { return view('admin.documents'); })->name('Documents');
Route::get('/blank', function () { return view('admin.blank'); })->name('Blank');
Route::get('/Settings', function () { return view('admin.settings'); })->name('Settings');
Route::get('/AdminLogin', function () { return view('admin.login'); })->name('AdminLogin');