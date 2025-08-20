<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 会員登録フロー
//➀会員登録画面（表示）
Route::get('/register/step1', [UserController::class, 'showRegisterForm'])
    ->name('register.step1');

//➀会員登録画面（登録処理）
Route::post('/register/step1', [UserController::class, 'registerStep1'])
    ->name('register.step1.store');

//➁初期目標体重登録画面（表示）
Route::get('/register/step2', [UserController::class, 'showInitialWeightForm'])
    ->name('register.step2');

//➁初期目標体重登録画面（登録処理）
Route::post('/register/step2', [UserController::class, 'registerStep2'])
    ->name('register.step2.store');


// 体重管理画面関連
// 認証済みユーザーのみアクセスできるグループ
Route::middleware('auth')->group(function () {

    //➃管理画面（表示）
    Route::get('/weight_logs', [WeightController::class, 'index'])
        ->name('weight_logs.index');
    
    //➃管理画面（検索）
    Route::get('/weight_logs/search', [WeightController::class, 'search'])
        ->name('weight_logs.search');

    //➃管理画面（登録(体重追加)処理）※モーダルウィンドウ内
    Route::post('/weight_logs/create', [WeightController::class, 'store'])
        ->name('weight_logs.store');

    //➄情報更新画面（表示）
    Route::get('/weight_logs/{weightLogId}', [WeightController::class, 'show'])
        ->name('weight_logs.show');

    //➄情報更新画面（更新処理）
    Route::patch('/weight_logs/{weightLogId}/update', [WeightController::class, 'update'])
        ->name('weight_logs.update');

    //➄情報更新画面（削除処理）
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightController::class, 'destroy'])
        ->name('weight_logs.destroy');

    //➅目標体重変更画面（表示）
    Route::get('/weight_logs/goal_setting', [WeightController::class, 'goalForm'])
        ->name('weight_logs.goal.form');

    //➅目標体重変更画面（変更処理）
    Route::patch('/weight_logs/goal_setting', [WeightController::class, 'updateGoal'])
        ->name('weight_logs.goal.update');
});

/*ログアウト後ログインページへ*/
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); 
})->name('logout');