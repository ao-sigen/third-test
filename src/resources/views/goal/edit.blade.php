@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css') }}">
@endsection

@section('content')
<div class="goal-container">
    <h2>目標体重を変更</h2>
    <form action="{{ route('goal.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="target_weight">目標体重（kg）</label>
            <input
                type="text"
                id="target_weight"
                name="target_weight"
                value="{{ old('target_weight', $goal->target_weight ?? '') }}">
            @error('target_weight')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-group">
            <button type="submit">更新</button>
            <a href="{{ route('weight_logs.index') }}">戻る</a>
        </div>
    </form>
</div>
@endsection