@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
@endsection

@section('content')
<div class="main-container">



    {{-- ステータス表示 --}}
    <div class="status-box">
        <div class="status-item">目標体重：<strong>{{ $targetWeight }}kg</strong></div>
        <div class="status-item">目標まで：<strong>{{ $targetWeight - $currentWeight }}kg</strong></div>
        <div class="status-item">最新体重：<strong>{{ $currentWeight }}kg</strong></div>
    </div>

    <div class="data-box">
        <div class="top-bar">
            <form action="{{ route('weight_logs.search') }}" method="GET" class="search-form">
                <input type="date" name="from" value="{{ request('from') }}">
                <span>〜</span>
                <input type="date" name="to" value="{{ request('to') }}">
                <button class="btn">検索</button>

                {{-- リセットボタン --}}
                <a href="{{ route('weight_logs.index') }}" class="btn reset-btn">リセット</a>
            </form>

            {{-- データ追加ボタン（右寄せ、グラデーション指定） --}}
            <button id="openModal" class="btn-add">データ追加</button>
        </div>

        @if(isset($search_summary))
        <p class="search-summary">{{ $search_summary }}</p>
        @endif


        <div class="log-list">
            <div class="log-header">
                <div>日付</div>
                <div>体重</div>
                <div>カロリー</div>
                <div>運動時間</div>
            </div>
            @foreach($weightLogs as $log)
            <div class="log-item">
                <div>{{ optional($log->date)->format('Y/m/d') ?? '未登録' }}</div>
                <div>{{ number_format($log->weight, 1) }}kg</div>
                <div>{{ $log->calories }}kcal</div>
                <div>{{ floor($log->exercise_time / 60) }}時間 {{ $log->exercise_time % 60 }}分</div>
                <div>
                    <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-icon">🖊</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $weightLogs->links() }}
        </div>
    </div>
</div>
{{-- モーダル内フォームの上部にエラー表示を追加 --}}
@if ($errors->any())
<div class="error-box">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="error-message">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@include('weight_logs.create_modal')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');
        const modal = document.getElementById('modal');

        if (openBtn && closeBtn && modal) {
            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        }
    });
</script>

@endsection