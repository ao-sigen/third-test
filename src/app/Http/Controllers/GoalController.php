<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateGoalRequest;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $goal = $user->goal;

        return view('goal.edit', compact('goal'));
    }

    public function update(UpdateGoalRequest $request)
    {
        $goal = Auth::user()->goal;

        if (!$goal) {
            // 目標体重データが存在しない場合は新規作成するか、エラー表示するなどの対応が必要
            abort(404, '目標体重データが見つかりません');
        }

        $this->authorize('update', $goal);

        $goal->target_weight = $request->input('target_weight');
        $goal->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました');
    }
}
