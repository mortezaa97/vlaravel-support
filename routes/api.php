<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Mortezaa97\Stories\Http\Controllers\StoryController;
use Mortezaa97\Support\Http\Controllers\DepartmentController;
use Mortezaa97\Support\Http\Controllers\TicketController;

Route::prefix('api/tickets')->group(function () {
    Route::post('/', [TicketController::class, 'store'])->middleware('auth:api')->name('tickets.store');
    Route::get('/', [TicketController::class, 'index'])->middleware('auth:api')->name('tickets.index');
    Route::get('/{ticket:code}', [TicketController::class, 'show'])->middleware('auth:api')->name('tickets.show');
    Route::post('/{ticket:code}/reply', [TicketController::class, 'reply'])->middleware('auth:api')->name('tickets.reply');
});
Route::get('api/departments', [DepartmentController::class, 'index'])->middleware('auth:api')->name('departments.index');

