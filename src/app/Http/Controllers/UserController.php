<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;


class UserController extends Controller
{
    //➀会員登録ページ（表示）
    public function showRegisterForm() {

        return view('register.step1');
    }

    //➀会員登録ページ（登録処理）
    public function registerStep1(RegisterStep1Request $request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => false, //仮登録（is_active=false）
        ]);

        // 登録と同時にログイン
        Auth::login($user);

        return redirect()->route('register.step2');
    }


    //➁初回目標体重登録（表示）
    public function showInitialWeightForm() {

        return view('register.step2');
    }

    //➁初回目標体重登録（登録処理）
    public function registerStep2(RegisterStep2Request $request) {

        $user = Auth::user(); // ログイン済みユーザーを取得

        // weight_logs テーブルに初回体重を登録
        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(), // 初回登録日
            'weight' => $request->current_weight,  // 現在の体重
        ]);

        // weight_target テーブルに目標体重を登録
        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        $user->update(['is_active' => true]); //仮登録フラグ is_active を true に変更

        return redirect()->route('weight_logs.index');
    }

}
