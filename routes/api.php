<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
//API route to fetch spesific ticket's logs
Route::get('/progresslogs/showLogs/{ticket_id}', [App\Http\Controllers\API\ProgressLogController::class, 'showLogs'])->name('progresslogs.showlogs');
Route::resource('progresslogs', App\Http\Controllers\API\ProgressLogController::class);

Route::resource('tickets', App\Http\Controllers\API\TicketController::class)->only([
    'store', 'show'
]);
Route::resource('ratings', App\Http\Controllers\API\RatingController::class);

//Protecting Routes
/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    // Route::resource('ratings', App\Http\Controllers\API\RatingController::class);
    // Route::resource('tickets', App\Http\Controllers\API\TicketController::class);
    Route::resource('tickets', App\Http\Controllers\API\TicketController::class)->only([
        'index', 'update', 'destroy'
    ]);

    Route::resource('listguests', App\Http\Controllers\API\ListGuestController::class);
});
