<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WeightTarget;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/register/step2'); // 初期体重登録画面へ
    }

    public function storeInitialWeight(Request $request)
    {
        $request->validate([
            'current_weight' => 'required|numeric|min:0',
            'target_weight' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        // すでにレコードがある場合は更新、なければ新規作成
        $weightTarget = WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            [
                'current_weight' => $request->current_weight,
                'target_weight' => $request->target_weight,
            ]
        );

        // 登録後に体重ログ一覧（index）へリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '体重データを保存しました');
    }
}
