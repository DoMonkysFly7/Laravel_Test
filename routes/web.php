<?php

use Illuminate\Support\Facades\Route;

// XMLTest
use App\Http\Controllers\XMLTestController;
Route::get('/', [XMLTestController::class, 'index'])->name('index');

