<?php

use Illuminate\Support\Facades\Route;


Route::post('generate', [\App\Http\Controllers\api\v1\MainController::class,'getShortUrl'])->name('getShortUrl');
