<?php

use App\Http\Controllers\CitizenWorkflowController;
use Illuminate\Support\Facades\Route;

// Redirect homepage or entry points missing parameters gracefully
Route::get('/', function () {
    return view('citizen'); 
});

// Localization Switcher Route with secure fallback
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'np'])) {
        session(['locale' => $locale]);
    }
    // Fallback to home if there is no HTTP_REFERER header
    return redirect()->back(fallback: '/');
})->name('lang.switch');

// Main Citizen QR Code Gateway
Route::get('/scan', [CitizenWorkflowController::class, 'handleScan'])->name('workflow.scan');

// Service Selection & Roadmap Views
Route::get('/workflow/{token}/select-service', [CitizenWorkflowController::class, 'showServiceSelection'])->name('workflow.select-service');
Route::post('/workflow/{token}/start', [CitizenWorkflowController::class, 'startService'])->name('workflow.start');
Route::get('/workflow/{token}/roadmap', [CitizenWorkflowController::class, 'showRoadmap'])->name('workflow.roadmap');

// Exit & Feedback Stages
Route::get('/workflow/{token}/checkout', [CitizenWorkflowController::class, 'showCheckout'])->name('workflow.checkout');
Route::post('/workflow/{token}/feedback', [CitizenWorkflowController::class, 'processFeedback'])->name('workflow.feedback');
Route::get('/workflow/{token}/thank-you', [CitizenWorkflowController::class, 'thankYou'])->name('workflow.thanks');