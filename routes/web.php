<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RSVPController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AdminController;

Route::get('/', [InvitationController::class, 'index'])->name('invite');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::post('/rsvp', [RSVPController::class, 'store'])->name('rsvp.store');
Route::post('/wishes', [WishController::class, 'store'])->name('wishes.store');

Route::get('/calendar.ics', [CalendarController::class, 'ics'])->name('calendar.ics');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/login', [AdminController::class, 'loginSubmit'])->name('admin.login');
Route::get('/admin/data', [AdminController::class, 'data'])->name('admin.data');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/test/{locale?}', [InvitationController::class, 'test'])->name('invite.test');
