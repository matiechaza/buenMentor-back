<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\MentorDetailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrexController;
use App\Http\Controllers\RegisterMentorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchMentorController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', static function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('register/mentor', [RegisterMentorController::class, 'showRegistrationForm'])->name('register.mentor.form');
Route::post('register/mentor', [RegisterMentorController::class, 'register'])->name('register.mentor');
Route::get('register/step2', [RegisterMentorController::class, 'showStep2'])
    ->middleware('auth')
    ->name('register.mentor.step2');
Route::post('register/step2', [RegisterMentorController::class, 'postStep2'])
    ->middleware('auth')
    ->name('register.mentor.step2.post');
Route::get('register/step3', [RegisterMentorController::class, 'showStep3'])
    ->middleware('auth')
    ->name('register.mentor.step3');
Route::post('register/step3', [RegisterMentorController::class, 'postStep3'])
    ->middleware('auth')
    ->name('register.mentor.step3.post');
Route::get('register/step4', [RegisterMentorController::class, 'showStep4'])
    ->middleware('auth')
    ->name('register.mentor.step4');
Route::post('register/step4', [RegisterMentorController::class, 'postStep4'])
    ->middleware('auth')
    ->name('register.mentor.step4.post');


Route::get('mentors', [SearchMentorController::class, 'index'])->name('mentors.index');
Route::get('mentors/{mentor}', [MentorDetailController::class, 'show'])->name('mentors.show');

Route::middleware('auth')->group(static function () {
    Route::post('booking/{mentor}/payment', [BookingController::class, 'payment'])
        ->name('bookings.payment');

    Route::get('prex', function () {
        return view('prex');
    })->name('prex');

    Route::post('/api/initiate-payment', [PrexController::class, 'initiatePayment']);


    Route::post('mentors/{mentor}/bookings', [BookingController::class, 'store'])->name('mentors.booking.post');
    Route::get('bookings/payment/pending/{booking}', [BookingController::class, 'paymentPending'])
        ->name('bookings.payment.pending');
    Route::get('bookings/payment/success/{booking}', [BookingController::class, 'paymentSuccess'])
        ->name('bookings.payment.success');
    Route::get('bookings/payment/failure/{booking}', [BookingController::class, 'paymentFailure'])
        ->name('bookings.payment.failure');

    Route::get('booking/confirmation/{booking}', [BookingController::class, 'confirmation'])
        ->name('booking.confirmation');
    Route::get('booking/{booking}/add-to-google-calendar', [BookingController::class, 'addToGoogleCalendar'])
        ->name('bookings.addToGoogleCalendar');
    Route::get('booking/{booking}/redirect-to-google-calendar', [BookingController::class, 'redirectToGoogleCalendar'])
        ->name('bookings.redirectToGoogleCalendar');
});

Route::middleware('auth')
    ->resource('bookings', BookingController::class)
    ->only(['index', 'show', 'destroy']);

Route::post('mentors/{mentor}/review', [MentorDetailController::class, 'storeReview'])->name('mentors.review.store');
Route::middleware('auth')
    ->post('mentors/{mentor}/reviews', [ReviewController::class, 'store'])
    ->name('mentors.reviews.store');

Route::middleware('auth')
    ->get('notifications',  [NotificationController::class, 'index'])
    ->name('notifications.index');
Route::middleware('auth')
    ->get('notifications/read/{id}', [NotificationController::class, 'markAsRead'])
    ->name('notifications.read');

