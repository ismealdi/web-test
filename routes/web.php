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

Route::get('/', function () {
    return redirect('page/students');
});

Route::get('page/{first}/{second?}', [App\Http\Controllers\DashboardController::class, 'route'])->name('route');

Route::resource('students', App\Http\Controllers\StudentController::class);
Route::resource('medicals', App\Http\Controllers\MedicalController::class);

Route::get('list/students', [App\Http\Controllers\StudentController::class, 'list'])->name('students.list');