<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('/', [ConferenceController::class, 'index'])->name('home');

Route::resource('conferences', ConferenceController::class);

Route::get('conferences/{conference}/members/create', [MemberController::class, 'create'])->name('members.create');
Route::post('conferences/{conference}/members', [MemberController::class, 'store'])->name('members.store');
