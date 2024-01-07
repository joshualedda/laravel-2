<?php

use Livewire\Livewire;
use App\Livewire\AddUser;
use App\Livewire\Reports;
use App\Livewire\Dashboard;
use App\Livewire\AuditTrail;
use App\Livewire\DataBackup;
use App\Livewire\StudentAdd;
use App\Livewire\UpdateUser;
use App\Livewire\EditGrantee;
use App\Livewire\ScholarEdit;
use App\Livewire\ScholarView;
use App\Livewire\SchoolYears;
use App\Livewire\StudentEdit;
use App\Livewire\StudentInfo;
use App\Livewire\UserAccount;
use App\Livewire\ViewGrantee;
use App\Livewire\CampusCourse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::middleware(['guest'])->group(function () {

    // log in
    Route::get('/auth/login', function () {
        return view('auth.login');
    });
    Route::get('/login', [ LoginController::class, 'login'])->name('auth.login');
    Route::post('/login', [ LoginController::class, 'loginAction'])->name('login.action');
    // Route::get('/logout', [ LoginController::class, 'logout'])->name('logout');

});




// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// barChart
Route::post('/filter', [DashboardController::class, 'filterData']);


// Student
Route::get('/student', StudentAdd::class)->name('student-add');

// Add student
Route::get('/studentInfo', StudentInfo::class)->name('student-info');

// view
Route::get('/studentGrantee/{rowId}', StudentEdit::class)->name('student-edit');

// scholarship
// viewGrantee
Route::get('/viewGrantee', ViewGrantee::class)->name('view-grantee');
Route::get('/viewGrantee/government', ViewGrantee::class)->name('viewGrantee.government');
Route::get('/viewGrantee/private', ViewGrantee::class)->name('viewGrantee.private');
// edit


// viewGrantee
Route::get('/editGrantee/{editId}', EditGrantee::class)->name('edit-grantee');


// Settings
//accountSet
Route::get('/userAccount', UserAccount::class)->name('user-account');
// update the account
Route::get('/updateAccount/{userId}', UpdateUser::class)->name('update-user');

//Add scholarship
// view
Route::get('/scholarView', ScholarView::class)->name('scholar-view');
// Edit
Route::get('/scholarEdit/{scholar}', ScholarEdit::class)->name('scholar-edit');

// adding User
Route::get('/registerUser', AddUser::class)->name('add-user');

// audit Trail
Route::get('/auditTrail', AuditTrail::class)->name('audit-trail');

// backup
Route::get('/backUp', DataBackup::class)->name('data-backup');

// campus && course
Route::get('/programCampus', CampusCourse::class)->name('campus-course');

// schooleYear
Route::get('/schoolYear', SchoolYears::class)->name('school-year');

// reports
Route::get('/studentReports', Reports::class)->name('reports');
