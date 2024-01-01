<?php

use Livewire\Livewire;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\StudentAdd;
use App\Http\Livewire\StudentEdit;
use App\Http\Livewire\StudentInfo;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
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
Route::get('/login', [ LoginController::class, 'login'])->name('auth.login');
Route::post('/login', [ LoginController::class, 'loginAction'])->name('login.action');


// dashboard
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Student
Route::get('/student', StudentAdd::class)->name('student-add');

// Add student
Route::get('/studentInfo', StudentInfo::class)->name('student-info');

// view
Route::get('/studentGrantee/{studentId}', StudentEdit::class)->name('student-edit');



