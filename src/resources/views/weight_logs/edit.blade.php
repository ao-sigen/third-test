@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Weight Log</h2>

    <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="date">日付</label>
        <input type="date" id="date" name="date" value="{{ old('date', $weightLog->date->format('Y-m-d')) }}">
        @error('date') <p class="error">{{ $message }}</p> @enderror

        <label for="weight">体重 (kg)</label>
        <input type="number" step="0.1" id="weight" name="weight" value="{{ old('weight', $weightLog->weight) }}">
        @error('weight') <p class="error">{{ $message }}</p> @enderror

        <label for="calories">摂取カロリー</label>
        <input type="number" id="calories" name="calories" value="{{ old('calories', $weightLog->calories) }}">
        @error('calories') <p class="error">{{ $message }}</p> @enderror

        <label for="exercise_time">運動時間 (分)</label>
        <input type="number" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
        @error('exercise_time') <p class="error">{{ $message }}</p> @enderror

        <label for="exercise_content">運動内容</label>
        <input type="text" id="exercise_content" name="exercise_content" value="{{ old('exercise_content', $weightLog->exercise_content) }}">
        @error('exercise_content') <p class="error">{{ $message }}</p> @enderror

        <div class="button-row">
            <a href="{{ route('weight_logs.index') }}" class="back-btn">戻る</a>
            <button type="submit" class="update-btn">更新</button>
        </div>
    </form>
    <form action="{{ route('weight_logs.destroy', $weightLog->id) }}" method="POST" class="delete-form" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-btn">削除</button>
    </form>

</div>
@endsection