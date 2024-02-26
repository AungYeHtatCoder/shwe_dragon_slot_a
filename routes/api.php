<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Bank\BankController;
use App\Http\Controllers\Api\V1\game\GameController;
use App\Http\Controllers\Api\V1\PromotionController;
use App\Http\Controllers\Api\V1\game\PlaceBetController;
use App\Http\Controllers\Api\V1\game\RollbackController;
use App\Http\Controllers\Api\V1\game\GameResultController;
use App\Http\Controllers\Api\V1\game\GetBalanceController;
use App\Http\Controllers\Api\V1\game\LaunchGameController;
use App\Http\Controllers\Api\V1\Player\WithDrawController;
use App\Http\Controllers\Api\V1\Player\PlayerTransactionLogController;

//login route post
Route::post('/login', [AuthController::class, 'login']);
Route::get('promotion', [PromotionController::class, 'index']);
Route::get('banner', [BannerController::class, 'index']);
Route::get('v1/validate',[AuthController::class,'callback']);
//Route::post('Seamless/GetBalance', [GetBalanceController::class, 'getBalance']);
Route::post('Seamless/GameResult', [GameResultController::class, 'gameResult']);

Route::group(["middleware" => ['auth:sanctum']], function () {
    //logout
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('changePassword', [AuthController::class, 'changePassword']);
    Route::post('profile', [AuthController::class, 'profile']);

    Route::group(['prefix' => 'transaction'], function () {
        Route::post('withdraw',[WithDrawController::class,'withdraw']);
        Route::get('player-transactionlog',[PlayerTransactionLogController::class,'index']);
    });

    Route::group(['prefix' => 'bank'], function () {
        Route::get('all', [BankController::class, 'all']);
    });
    Route::group(['prefix' => 'game'], function () {
        Route::get('gameType',[GameController::class,'gameType']);
        Route::get('gameTypeProducts/{id}', [GameController::class, 'gameTypeProducts']);
        Route::post('Seamless/LaunchGame', [LaunchGameController::class, 'launchGame']);

    });
});

Route::group(['prefix' => 'Seamless'], function () {
    Route::post('GetGameList', [LaunchGameController::class, 'getGameList']);
    Route::post('GetBalance', [GetBalanceController::class, 'getBalance']);
    // Route::post('GameResult', [GameResultController::class, 'gameResult']);
    Route::post('Rollback', [RollbackController::class, 'rollback']);
    Route::post('PlaceBet', [PlaceBetController::class, 'placeBet']);

});