<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン - PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>

<body>
    <main>
        <div class="register-wrapper">
            <div class="register-container">
                <div class="register-header">
                    <h1 class="title">PiGLy</h1>
                    <h2 class="subtitle">新規会員登録</h2>
                    <p class="step-info">STEP1 アカウント情報の登録</p>
                </div>

                <form action="{{ route('register.step1') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">お名前</label>
                        <input type="text" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="password">
                        @error('password')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="button-area">
                        <button type="submit" class="submit-button">次に進む</button>
                    </div>
                </form>

                <div class="login-link">
                    <a href="{{ route('login') }}">ログインはこちら</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>