<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DeveloperController;

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
    Route::get('remove_developers_from_project/{p_id}/{d_id}', [ProjectController::class, 'remove_developers_from_project'])->name('remove_developers_from_project');
    Route::post('create_task', [TaskController::class, 'create_task'])->name('create_task');
});

Route::middleware(['DeveloperLogin'])->group(function () {
    Route::get('developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
    Route::get('developer/logout', [AuthController::class, 'developer_logout'])->name('developer.logout');
    Route::get('developer/manage/projects', [ProjectController::class, 'developer_manage_projects'])->name('developer.manage.projects');
    Route::get('developer/project/details/{id}', [ProjectController::class, 'developer_project_details'])->name('developer_project_details');
    Route::post('developer/update_status_task/{id}', [TaskController::class, 'update_status_task'])->name('update_status_task');

});
