<?php

use App\Livewire\Dashboard;
use App\Livewire\StudentAdd;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

// log in
Route::get('/auth/login', function () {
    return view('auth.login');
});
Route::get('login', [ LoginController::class, 'login'])->name('auth.login');
Route::post('login', [ LoginController::class, 'loginAction'])->name('login.action');

// dashboard
Route::get('dashboard', Dashboard::class)->name('dashboard');

// Add Student
Route::get('student-add', StudentAdd::class)->name('student-add');