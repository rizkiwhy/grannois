<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\GraduationAnnouncementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompetencyOfExpertiseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/graduation-announcement');
})->name('index');

// Route::resources([
//     '/graduation-announcement' => GraduationAnnouncementController::class,
// ]);

Route::get('/graduation-announcement', [
    GraduationAnnouncementController::class,
    'index',
]);

Route::get('/login', [AuthController::class, 'login'])->name('login.view');
Route::post('/login', [AuthController::class, 'actionLogin'])->name(
    'login.action'
);

Route::middleware(['auth', 'check.roleid:1,2,3'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resources([
        'dashboard' => DashboardController::class,
    ]);
});

Route::middleware(['auth', 'check.roleid:1,2'])->group(function () {
    Route::resources([
        'activity' => ActivityController::class,
        'announcement' => AnnouncementController::class,
        'graduation' => GraduationController::class,
        'competencyofexpertise' => CompetencyOfExpertiseController::class,
    ]);
});

Route::middleware(['auth', 'check.roleid:1,2'])->group(function () {
    Route::resources([
        'role' => RoleController::class,
        'user' => UserController::class,
    ]);
});
