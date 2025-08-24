<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use App\Http\Requests\GoalUpdateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\StoreContactRequest;

class WeightController extends Controller
{
    //➃体重管理画面（表示）
    public function index()
    {
        $userId = Auth::id();

        // 最新体重（ログがある場合は最新日付のもの）
        $latestWeightLog = WeightLog::where('user_id', Auth::id())
                                    ->orderBy('date', 'desc')
                                    ->first();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : 0;

        // 目標体重
        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        $goalWeight = $weightTarget ? $weightTarget->target_weight : 0;

        // 目標まで
        $goalWeightDiff = $goalWeight - $latestWeight;

        // 検索条件なしで全件ログ取得
        $weightLogs = WeightLog::where('user_id', Auth::id())
                               ->orderBy('date', 'desc')
                               ->paginate(8)
                               ->withQueryString();

        $searchCount = $weightLogs->total();

        return view('weight_logs.index', compact(
            'weightLogs',
            'goalWeight',
            'goalWeightDiff',
            'latestWeight',
            'searchCount'
        ));
    }

    //➃管理画面（検索）
    public function search(Request $request)
    {
        $weightTarget = WeightTarget::where('user_id', Auth::id())->first();
        $goalWeight = $weightTarget ? $weightTarget->target_weight : 0;

        $latestWeightLog = WeightLog::where('user_id', Auth::id())
                                    ->orderBy('date', 'desc')
                                    ->first();
        $latestWeight = $latestWeightLog ? $latestWeightLog->weight : 0;
        $goalWeightDiff = $goalWeight - $latestWeight;

        // 日付検索をしてログ取得
        $weightLogs = WeightLog::where('user_id', Auth::id())
                            ->dateRange($request->from, $request->to)
                            ->orderBy('date', 'desc')
                            ->paginate(8)
                            ->withQueryString();

        $searchCount = $weightLogs->total();

        return view('weight_logs.index', compact(
            'weightLogs',
            'goalWeight',
            'goalWeightDiff',
            'latestWeight',
            'searchCount'
        ));
    }

    //➃管理画面（モーダル登録）
    public function store(StoreContactRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }


    //➄情報更新画面（表示）
    public function show($id) {

        $weightLog = WeightLog::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->firstOrFail();

        return view('weight_logs.show', compact('weightLog'));
    }

    //➄情報更新画面（更新処理）
    public function update(UpdateRequest $request,$id) {

        // ログインユーザーの対象レコードを取得（更新する先）
        $weightLog = WeightLog::where('user_id', Auth::id())
                          ->where('id', $id)
                          ->firstOrFail();

        // フォームから来た値で上書き
        $weightLog->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }

    //➄情報更新画面（削除処理）
    public function destroy($id)
    {
        // ログインユーザーの対象レコードを取得（削除する先）
        $weightLog = WeightLog::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $weightLog->delete();

        return redirect()->route('weight_logs.index');
    }


    //➅目標体重変更画面（表示）
    public function goalForm() {

        return view('weight_logs.goal_setting');
    }

    //➅目標体重変更画面（変更処理）
    public function goalUpdate(GoalUpdateRequest $request) {

        // 入力値を取得
        $target_weight=$request->goal_weight;

        // ログインユーザーの目標体重レコード取得(更新する先)
        $weightTarget = WeightTarget::where('user_id', Auth::id())->first();

        // 上書き更新
        $weightTarget->update([
            'target_weight' => $target_weight,
        ]);
        
        return redirect()-> route('weight_logs.index');
    }
}
