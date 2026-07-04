<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkReportController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::controller(WorkReportController::class)->group(function () {
        Route::get('workreport', 'show')->name('workreport.showForm')->middleware(['throttle:60,1']);
        Route::post('add-task', 'addTask')->name('workreport.addTask')->middleware(['throttle:60,1']);
        Route::get('workreport/{id}', 'view')->name('workreport.view');
        Route::delete('workreportdestroy/{id}', 'destroy')->name('workreport.destroy')->middleware(['throttle:60,1']);
        
    });
});

require __DIR__.'/settings.php';
