<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\BannerTextController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Agent\AgentController;
use App\Http\Controllers\Report\TestReportController;
use App\Http\Controllers\Admin\GetBetDetailController;
use App\Http\Controllers\Admin\Master\MasterController;
use App\Http\Controllers\Admin\Player\PlayerController;
use App\Http\Controllers\Admin\GameTypeProductController;
use App\Http\Controllers\Admin\TransferLog\TransferLogController;
use App\Http\Controllers\Admin\WithDraw\WithDrawRequestController;

Route::group([
    'prefix' => 'admin', 'as' => 'admin.',
    'middleware' => ['auth', 'checkBanned']
], function () {
    Route::post('test', function () {
        dd('here');
    })->name('test');

    Route::post('balance-up', [HomeController::class, 'balanceUp'])->name('balanceUp');
    Route::get('logs/{id}', [HomeController::class, 'logs'])
        ->name('logs');
    // Permissions
    Route::resource('permissions', PermissionController::class);
    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);
    // Players
    Route::delete('user/destroy', [PlayerController::class, 'massDestroy'])->name('user.massDestroy');

    Route::put('player/{id}/ban', [PlayerController::class, 'banUser'])->name('player.ban');
    Route::resource('player', PlayerController::class);
    Route::get('player-cash-in/{player}', [PlayerController::class, 'getCashIn'])->name('player.getCashIn');
    Route::post('player-cash-in/{player}', [PlayerController::class, 'makeCashIn'])->name('player.makeCashIn');
    Route::get('player/cash-out/{player}', [PlayerController::class, 'getCashOut'])->name('player.getCashOut');
    Route::post('player/cash-out/update/{player}', [PlayerController::class, 'makeCashOut'])
        ->name('player.makeCashOut');
    Route::get('player-changepassword/{id}', [PlayerController::class, 'getChangePassword'])->name('player.getChangePassword');
    Route::post('player-changepassword/{id}', [PlayerController::class, 'makeChangePassword'])->name('player.makeChangePassword');



    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/change-password/{user}', [ProfileController::class, 'updatePassword'])
        ->name('profile.updatePassword');


    // user profile route get method
    Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
    // PhoneAddressChange route with auth id route with put method
    Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
    Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
    Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
    Route::resource('banners', BannerController::class);
    Route::resource('text', BannerTextController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/payments', PaymentController::class);
    Route::get('gametypes', [GameTypeProductController::class, 'index'])->name('gametypes.index');
    Route::get('gametypes/{game_type_id}/product/{product_id}', [GameTypeProductController::class, 'edit'])->name('gametypes.edit');
    Route::post('gametypes/{game_type_id}/product/{product_id}', [GameTypeProductController::class, 'update'])->name('gametypes.update');

    Route::resource('agent', AgentController::class);
    Route::get('agent-cash-in/{id}', [AgentController::class, 'getCashIn'])->name('agent.getCashIn');
    Route::post('agent-cash-in/{id}', [AgentController::class, 'makeCashIn'])->name('agent.makeCashIn');
    Route::get('agent/cash-out/{id}', [AgentController::class, 'getCashOut'])->name('agent.getCashOut');
    Route::post('agent/cash-out/update/{id}', [AgentController::class, 'makeCashOut'])
        ->name('agent.makeCashOut');
    Route::put('agent/{id}/ban', [AgentController::class, 'banAgent'])->name('agent.ban');
    Route::get('agent-changepassword/{id}', [AgentController::class, 'getChangePassword'])->name('agent.getChangePassword');
    Route::post('agent-changepassword/{id}', [AgentController::class, 'makeChangePassword'])->name('agent.makeChangePassword');

    Route::resource('master', MasterController::class);
    Route::get('master-cash-in/{id}', [MasterController::class, 'getCashIn'])->name('master.getCashIn');
    Route::post('master-cash-in/{id}', [MasterController::class, 'makeCashIn'])->name('master.makeCashIn');
    Route::get('master/cash-out/{id}', [MasterController::class, 'getCashOut'])->name('master.getCashOut');
    Route::post('master/cash-out/update/{id}', [MasterController::class, 'makeCashOut'])
        ->name('master.makeCashOut');
    Route::put('master/{id}/ban', [MasterController::class, 'banMaster'])->name('master.ban');
    Route::get('master-changepassword/{id}', [MasterController::class, 'getChangePassword'])->name('master.getChangePassword');
    Route::post('master-changepassword/{id}', [MasterController::class, 'makeChangePassword'])->name('master.makeChangePassword');


    Route::get('withdraw', [WithDrawRequestController::class, 'index'])->name('agent.withdraw');
    Route::get('withdraw/{id}', [WithDrawRequestController::class, 'show'])->name('agent.withdrawshow');

    Route::post('withdraw/{withdraw}', [WithDrawRequestController::class, 'statusChange'])->name('agent.statusChange');

    Route::get('transer-log', [TransferLogController::class, 'index'])->name('transferLog');
    Route::get('transferlog/{id}', [TransferLogController::class, 'transferLog'])->name('transferLogDetail');

    Route::group(['prefix' => 'report'], function () {
        Route::get('index', [ReportController::class, 'index'])->name('report.index');
        Route::get('view/{user_id}', [ReportController::class, 'view'])->name('report.view');
        Route::get('show/{proudct_code}', [ReportController::class, 'show'])->name('report.show');
        Route::get('detail/{user_id}/{product_code}', [ReportController::class, 'detail'])->name('report.detail');
    });

    // get bet deatil 
    Route::get('get-bet-detail', [GetBetDetailController::class, 'index'])->name('getBetDetail');
    Route::get('get-bet-detail/{wagerId}', [GetBetDetailController::class, 'getBetDetail'])->name('getBetDetail.show');

    Route::resource('/product_code', App\Http\Controllers\Admin\ProductCodeController::class);
});
