@extends('layouts.app')

@section('content')

<div class="goal">

  <form action="{{ route('weight_logs.goal.update') }}" method="POST" class="goal__form-content">
    @csrf
    @method('PATCH')

    <div class="goal__title">
      <h1 class="goal__title-text">目標体重設定</h1>
    </div>

    <div class="goal__content">
      <div class="weight-input-wrapper">
          <input type="text" name="goal_weight" class="goal__input" placeholder="目標体重を入力" value="{{ old('goal_weight') }}">
          <span class="unit">kg</span>
      </div>
    </div>
    @error('goal_weight')
      <div class="error-message">{{ $message }}</div>
    @enderror

    <div class="goal__buttons">
      <a href="{{ route('weight_logs.index') }}" class="goal__back-button">戻る</a>
      <button class="goal__submit-button" type="submit">更新</button>
    </div>

  </form>

</div>

@endsection
