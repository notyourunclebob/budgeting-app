<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::get('/',[BudgetController::class, 'index']);
