<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;

class WeightLogController extends Controller
{
    public function showStep2()
    {
        return view('register.step2');
    }

    public function storeInitialWeight(Request $request)
    {
        $request->validate([
            'current_weight' => 'required|numeric',
            'target_weight' => 'required|numeric',
        ]);

        $user = Auth::user(); // ログインしているか確認

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'ログインしてください']);
        }

        // 初期体重を登録
        WeightTarget::create([
            'user_id' => $user->id,
            'current_weight' => $request->current_weight,
            'target_weight' => $request->target_weight,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '初期体重を登録しました');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // 体重ログはそのまま取得
        $query = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc');

        if ($request->filled('from')) {
            $query->where('date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('date', '<=', $request->to);
        }

        $weightLogs = $query->paginate(6);

        // weight_targetsテーブルから最新の目標体重・現在体重を取得
        $weightTarget = WeightTarget::where('user_id', $user->id)->first();

        // 最新の体重ログの体重も取得（あれば）
        $latestLog = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->first();

        return view('weight_logs.index', [
            'weightLogs' => $weightLogs,
            'targetWeight' => $weightTarget->target_weight ?? 0,
            'currentWeight' => $weightTarget->current_weight ?? ($latestLog->weight ?? 0),
        ]);
    }

    public function edit($id)
    {
        $weightLog = WeightLog::findOrFail($id);

        // 認可チェック（例）
        $this->authorize('update', $weightLog);

        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(Request $request, $id)
    {
        $weightLog = WeightLog::findOrFail($id);
        $this->authorize('update', $weightLog);

        $validated = $request->validate([
            'date' => 'required|date',
            'weight' => ['required', 'numeric', 'digits_between:1,4', 'regex:/^\d+(\.\d{1})?$/'],
            'calories' => 'required|numeric',
            'exercise_time' => 'required|numeric',
            'exercise_content' => 'nullable|string|max:120',
        ], [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.digits_between' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ]);

        $weightLog->update($validated);

        return redirect()->route('weight_logs.index')->with('success', '体重ログを更新しました');
    }

    public function destroy($id)
    {
        $weightLog = WeightLog::findOrFail($id);
        $this->authorize('delete', $weightLog);

        $weightLog->delete();

        return redirect()->route('weight_logs.index')->with('success', '体重ログを削除しました');
    }


    public function search(Request $request)
    {
        $query = WeightLog::query();

        // フィルター処理
        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->input('from'));
        }
        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->input('to'));
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(6);

        // 現在・目標体重を取得（例：ログインユーザー基準）
        $currentWeight = optional($weightLogs->first())->weight ?? 0;
        $targetWeight = auth()->user()->weightTarget->target_weight ?? 0;

        return view('weight_logs.index', [
            'weightLogs' => $weightLogs,
            'currentWeight' => $currentWeight,
            'targetWeight' => $targetWeight,
            'search_summary' => $request->from . ' 〜 ' . $request->to,
        ]);
    }
    public function store(WeightLogRequest $request)
    {
        $user = auth()->user();

        $user -> weightLogs ->create([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
            'current_weight' => $request->weight,
        ]);
        WeightLog::create($request->validated());
        return redirect()->route('weight_logs.index')->with('success', '体重ログを登録しました。');
    }
}