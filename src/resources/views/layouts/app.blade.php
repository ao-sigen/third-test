<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PiGly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="logo">
                <a href="{{ route('weight_logs.index') }}" class="logo-link">PiGly</a>
            </h1>

            <nav>
                <ul class="nav-list">
                    <li><a href="{{ route('goal.edit') }}">⚙目標体重変更</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button">
                                ログアウト
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    

    <main>
        @yield('content')
    </main>
</body>

</html>