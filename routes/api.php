<?php

use App\Http\Controllers\MessageTemplateController;
use App\Http\Controllers\MessageContactController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('messages')->group(function () {
    Route::get('send-messages', [MessageController::class, 'sendMessages']);
    Route::apiResource('/', MessageController::class)->parameters([
        '' => 'message',
    ]);
});
//Custom Routes
// Route::get('messages/send-messages', [MessageController::class, 'sendMessages']);

//Crud Routes
Route::apiResource('templates', MessageTemplateController::class);

Route::apiResource('contacts', MessageContactController::class);

Route::apiResource('messages', MessageController::class);

