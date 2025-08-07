<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Step1 の登録処理（名前、メール、パスワード）
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードの確認が一致しません。',
        ]);

        // ユーザー登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ログインさせる
        Auth::login($user);

        // 初期体重登録画面へリダイレクト
        return redirect('/register/step2');
    }

    // Step2（初期体重）の登録処理
    public function storeInitialWeight(Request $request)
    {
        $request->validate([
            'initial_weight' => ['required', 'numeric', 'between:1,999.9'],
        ]);

        $user = Auth::user();
        $user->initial_weight = $request->initial_weight;
        $user->save();

        return redirect('/weight_logs');
    }
}
