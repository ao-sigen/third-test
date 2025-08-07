@section('css')
<link rel="stylesheet" href="{{ asset('css/create_modal.css') }}">
@endsection


<div id="modal" class="modal hidden">
    <div class="modal-content">
        <h2>Weigth Logを追加</h2>
        <form action="{{ route('weight_logs.store') }}" method="POST">
            @csrf
            <label for="date" class="required-label">日付</label>
            <div class="input-with-unit">
                <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                @error('date')
                    <div class="error-message">{{ $message }}</div>
                @enderror

            </div>



            <label for="weight" class="required-label">体重</label>
            <div class="input-with-unit">
                <input type="number" id="weight" name="weight" step="0.1" min="0" max="300" required value="{{ old('weight') }}">
                <span class="unit">kg</span>
                @error('weight')
                    <div class="error-message">{{ $message }}</div>
                @enderror

            </div>

            <label for="calories" class="required-label">摂取カロリー</label>
            <div class="input-with-unit">
                <input type="number" id="calories" name="calories" min="0" required value="{{ old('calories') }}">
                <span class="unit">kcal</span>
                @error('calories')
                    <div class="error-message">{{ $message }}</div>
                @enderror

            </div>

            <label for="exercise_time" class="required-label">運動時間</label>
            <input type="number" id="exercise_time" name="exercise_time" min="0" required value="{{ old('exercise_time') }}" placeholder="分単位で入力">
            @error('exercise_time')
                <div class="error-message">{{ $message }}</div>
            @enderror


            <label for="exercise_content">運動内容</label>
            <input type="text" id="exercise_content" name="exercise_content" class="form-control exercise-textarea">

            <button type="button" id="closeModal" class="btn btn-close">戻る</button>
            <button type="submit" class="btn btn-submit">登録</button>

        </form>
    </div>
</div>