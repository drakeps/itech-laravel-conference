<?php

use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset'   => false,
    'confirm' => false,
    'verify'  => false,
]);

Route::get('/', [ConferenceController::class, 'index'])->name('home');

Route::resource('conferences', ConferenceController::class);
