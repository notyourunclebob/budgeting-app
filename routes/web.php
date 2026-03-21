<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::resource('budget', BudgetController::class);
