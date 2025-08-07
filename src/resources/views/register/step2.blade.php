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
            <div class="register-box">
                <h1 class="logo">PiGLy</h1>
                <h2 class="title">新規会員登録</h2>
                <p class="step-label">STEP2　体重データの入力</p>

                <form method="POST" action="{{ url('/register/step2') }}">
                    @csrf
                    <div class="form-group">
                        <label for="current_weight">現在の体重</label>
                        <input type="text" name="current_weight" id="current_weight" value="{{ old('current_weight') }}">
                        @error('current_weight')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="target_weight">目標の体重</label>
                        <input type="text" name="target_weight" id="target_weight" value="{{ old('target_weight') }}">
                        @error('target_weight')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="button-area">
                        <button type="submit" class="submit-button">アカウント作成</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>