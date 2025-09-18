<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ConfirmParticipantController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/participant/confirm/{token}', [ConfirmParticipantController::class, 'show'])->name('participant.confirm.show');
Route::post('/participant/confirm/{token}', [ConfirmParticipantController::class, 'store'])->name('participant.confirm.store');
