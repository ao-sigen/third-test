<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン - PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>


<body>
    <main>
        <div class="login-container">
            <form method="POST" action="{{ url('/login') }}">
            @csrf
                <div class="form-header">
                    <h1 class="logo">PiGLy</h1>
                    <h2 class="login-title">ログイン</h2>
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password">
                    @error('password')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">ログイン</button>

                <a href="{{ route('register.step1') }}" class="account-link">アカウント作成はこちら</a>
            </form>
        </div>
    </main>
</body>
