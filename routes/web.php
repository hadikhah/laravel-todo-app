<?php

use App\Http\Controllers\InertiaAdmin\Permission\PermissionController;
use App\Http\Controllers\InertiaAdmin\Role\RoleController;
use App\Http\Controllers\InertiaAdmin\User\ProfileController;
use App\Http\Controllers\InertiaAdmin\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::prefix("inertia")->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin'       => Route::has('login'),
            'canRegister'    => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion'     => PHP_VERSION,
        ]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__ . '/auth.php';

    Route::middleware('auth', "password.confirm")->group(function () {
        Route::get('about', function () {
            return Inertia::render('About');
        })->name('about');

        Route::resources([
            'users' => UserController::class,
            "roles" => RoleController::class,
            "permissions" => PermissionController::class,
        ]);

        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::domain("{user}." . config("app.url"))->group(function () {
    Route::get("/", [UserController::class, "show"])->middleware("password.confirm");
});

Route::get('/', function () {
    return "hey";
});
