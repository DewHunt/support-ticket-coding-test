<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/user/save', [UserController::class, 'save'])->name('user.save');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/add', [TicketController::class, 'add'])->name('ticket.add');
    Route::post('/ticket/save', [TicketController::class, 'save'])->name('ticket.save');
    Route::get('/ticket/edit/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::post('/ticket/update', [TicketController::class, 'update'])->name('ticket.update');
    Route::get('/ticket/response/{id}', [TicketController::class, 'response'])->name('ticket.response');
    Route::post('/ticket/save-response', [TicketController::class, 'saveResponse'])->name('ticket.save-response');
    Route::get('/ticket/status/{id}', [TicketController::class, 'status'])->name('ticket.status');
    Route::get('/ticket/delete/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
});
