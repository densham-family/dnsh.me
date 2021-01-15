<?php

use App\Http\Controllers\AnonymousShortcodeController;
use App\Http\Controllers\CreateShortlinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrackingShortcodeController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');
Route::post('/create', CreateShortlinkController::class)->middleware('auth')->name('create');

Route::get('/t/{link:code}', TrackingShortcodeController::class)->name('shortlink.track');
Route::get('/a/{link:code}', AnonymousShortcodeController::class)->name('shortlink.anon');

require __DIR__.'/auth.php';
