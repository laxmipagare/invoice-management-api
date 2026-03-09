<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InvoiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    // View Invoices (Admin + User)
    Route::get('/invoices',[InvoiceController::class,'index']);
    Route::get('/invoices/{id}',[InvoiceController::class,'show']);
    Route::get('/invoices/{id}/download',[InvoiceController::class,'downloadPDF']);
    Route::post('/logout', [AuthController::class,'logout']);
});
Route::middleware(['auth:sanctum','admin'])->group(function(){
    // Admin Only
    Route::post('/invoices',[InvoiceController::class,'store']);
    Route::put('/invoices/{id}',[InvoiceController::class,'update']);
    Route::delete('/invoices/{id}',[InvoiceController::class,'destroy']);
});
