<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\LectureController;
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

Route::get('lectures/{lecture}', [LectureController::class, 'show'])->name('lectures.show');

Route::middleware('role:manager')->group(function () {
    Route::post('lectures/{lecture}/accept', [LectureController::class, 'accept'])->name('lectures.accept');
    Route::post('lectures/{lecture}/reject', [LectureController::class, 'reject'])->name('lectures.reject');
});
