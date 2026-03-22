<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BudgetController::class, 'index'])->name('home');
Route::resource('budget', BudgetController::class);
Route::resource('expense', ExpenseController::class);
