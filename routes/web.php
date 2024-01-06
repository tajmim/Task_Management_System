<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ProjectController;

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
    if (Auth::guard('manager')->user()) {
        return redirect()->route('manager.dashboard');
    }
    if (Auth::guard('developer')->user()) {
        return redirect()->route('developer.dashboard');
    }
    return view('welcome');
})->name('home');



// =====================================Authentication============================
Route::post('manager/register', [AuthController::class, 'manager_register'])->name('manager.register');
Route::post('manager/login', [AuthController::class, 'manager_login'])->name('manager.login');
Route::post('developer/register', [AuthController::class, 'developer_register'])->name('developer.register');
Route::post('developer/login', [AuthController::class, 'developer_login'])->name('developer.login');




//
Route::middleware(['ManagerLogin'])->group(function () {
    Route::get('manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('manager/logout', [AuthController::class, 'manager_logout'])->name('manager.logout');
    Route::get('manager/manage/projects', [ProjectController::class, 'manage_projects'])->name('manage.projects');
    Route::post('create/project', [ProjectController::class, 'store_project'])->name('create_project');
    Route::get('project/details/{id}', [ProjectController::class, 'project_details'])->name('project_details');
    Route::post('add_developer_to_project/{id}', [ProjectController::class, 'add_developer_to_project'])->name('add_developer_to_project');
});

Route::middleware(['DeveloperLogin'])->group(function () {
    Route::get('developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
    Route::get('developer/logout', [AuthController::class, 'developer_logout'])->name('developer.logout');
});
