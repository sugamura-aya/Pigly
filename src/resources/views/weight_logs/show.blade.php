@extends('layouts.app')

@section('content')

<div class="weight-log-show">

  <div class="weight-log-show__form-wrapper">

    <h1 class="weight-log-show__title">Weight Log</h1>

    <form action="{{ route('weight_logs.update',$weightLog->id) }}" method="POST" class="weight-log-show__form">
      @csrf
      @method('PATCH')

      <table class="weight-log-show__table">

        <tr class="weight-log-show__row">
            <th class="weight-log-show__label">日付</th>
            <td class="weight-log-show__input-cell">
                <input type="date" name="date" class="weight-log-show__input" value="{{ old('date', date('Y-m-d')) }}">
                @error('date')
                <div class="weight-log-show__error">{{ $message }}</div>
                @enderror
            </td>
        </tr>

        <tr class="weight-log-show__row">
          <th class="weight-log-show__label">体重</th>
          <td class="weight-log-show__input-cell">
            <div class="weight-log-show__input-with-unit">
              <input type="text" name="weight" class="weight-log-show__input" placeholder="体重を入力してください" value="{{ old('weight',$weightLog->weight) }}">
              <span class="unit">kg</span>
            </div>
            @error('weight')
              <div class="weight-log-show__error">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <tr class="weight-log-show__row">
          <th class="weight-log-show__label">摂取カロリー</th>
          <td class="weight-log-show__input-cell">
            <div class="weight-log-show__input-with-unit">
              <input type="text" name="calories" class="weight-log-show__input" placeholder="摂取カロリーを入力してください" value="{{ old('calories',$weightLog->calories) }}">
              <span class="unit">cal</span>
            </div>
            @error('calories')
              <div class="weight-log-show__error">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <tr class="weight-log-show__row">
          <th class="weight-log-show__label">運動時間</th>
          <td class="weight-log-show__input-cell">
            <input type="time" name="exercise_time" class="weight-log-show__input" placeholder="運動時間を入力してください" value="{{ old('exercise_time',$weightLog->exercise_time) }}">
            @error('exercise_time')
              <div class="weight-log-show__error">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <tr class="weight-log-show__row">
          <th class="weight-log-show__label">運動内容</th>
          <td class="weight-log-show__input-cell">
            <textarea name="exercise_content" class="weight-log-show__textarea" placeholder="運動内容を入力してください">{{ old('exercise_content',$weightLog->exercise_content) }}</textarea>
            @error('exercise_content')
              <div class="weight-log-show__error">{{ $message }}</div>
            @enderror
          </td>
        </tr>

      </table>

      <div class="weight-log-show__submit">
        <a href="{{ route('weight_logs.index') }}" class="goal__back-button">戻る</a>
        <button type="submit" class="weight-log-show__submit-button">更新</button>
      </div>

    </form>

    {{-- 削除フォーム --}}
    <form action="{{ route('weight_logs.destroy',$weightLog->id) }}" method="post" class="weight-log-show__delete-form" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="weight-log-show__delete-button" title="削除">
          <img src="{{ asset('images/trash.icon.png') }}" alt="ログアウトアイコン" class="nav__icon">
        </button>
    </form>
  </div>

</div>

@endsection
