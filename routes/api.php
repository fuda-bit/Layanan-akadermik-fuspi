<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API routes are loaded by the RouteServiceProvider.
|
*/

Route::get('/test', function () {
    return response()->json([
        'status' => 'API aktif'
    ]);
});