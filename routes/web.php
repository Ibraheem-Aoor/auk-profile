<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\CrfCourseController;
use App\Http\Controllers\Site\IntrestedStudentController;
use App\Http\Controllers\Site\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashbaordController;
use App\Http\Controllers\User\AccountTreeController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Requests\Site\IntresetedStudentRegisterRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!b
|
*/


Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
// Site Routes
Route::group([
    'as' => 'site.'
], function () {
    Route::get('about', [HomeController::class, 'about'])->name('about');
    Route::get('partners', [HomeController::class, 'partners'])->name('partners');
    Route::get('E-Training', [HomeController::class, 'eTraining'])->name('etraining');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('intrested-student', [IntrestedStudentController::class, 'store'])->name('interest.submit');
    Route::post('contact-submit', [ContactController::class, 'store'])->name('contact.submit');
    // programs
    Route::prefix('programs')->name('programs.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('courses/{program}', [ProgramController::class, 'courses'])->name('courses');
    });
    // certifed freelancer courses
    Route::prefix('crf')->name('crf.')->group(function () {
        Route::get('/', [CrfCourseController::class, 'index'])->name('index');
        Route::get('/crf/{id}', [CrfCourseController::class, 'show'])->name('show');
    });
});

// User Routes
Route::prefix('user')
    ->middleware('auth')
    ->name('user.')->group(function () {
        Route::redirect('/', '/user/dashboard', 301);
        Route::get('/dashboard', [DashbaordController::class, 'dashboard'])->name('dashboard');
        Route::redirect('/dashboard' , 'contacts');
        Route::prefix('contacts')->name('contacts.')->group(function(){
            Route::get('', [UserContactController::class, 'index'])->name('index');
            Route::delete('/delete/{id}', [UserContactController::class, 'destroy'])->name('destroy');
            Route::get('/table-data', [UserContactController::class, 'getTableData'])->name('table');
        });
    });

