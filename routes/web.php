<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Api\ProjectController as ApiProjectController;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [GuestHomeController::class, 'index'])->name('home');

Route::middleware('auth')->name('admin.')->prefix('admin/')->group(
    function () {
        Route::get('projects/deleted-index', [ProjectController::class, "deletedIndex"])->name('projects.deleted-index');
        Route::patch('projects/restore/{project}', [ProjectController::class,  "restore"])->name('projects.restore');
        Route::delete('projects/permanent-delete/{project}', [ProjectController::class, "permanentDelete"])->name('projects.permanent-delete');
        Route::resource('projects', ProjectController::class);
        Route::resource('types', TypeController::class);
        Route::resource('technologies', TechnologyController::class);
    }
);

//rotte API
Route::get("/projects", [ApiProjectController::class, "index"])->name("api.projects.index");
Route::get("/projects/{project}", [ApiProjectController::class, "show"])->name("api.projects.show");
