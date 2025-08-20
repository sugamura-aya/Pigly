<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pigly(register)</title>
  {{--リセットCSS--}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  {{--register.cssファイル呼び出し--}}
  <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
  {{--webフォント
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libertinus+Math&display=swap" rel="stylesheet">--}}
</head>

<body>
    <main>

      <h1 class="register-title">PiGLy</h1>
      <h2 class="register-subtitle">新規会員登録</h2>

      <p class="register-step">STEP2 体重データの入力</p>

      <div class="register-form">

        <form action="{{ route('register.step2') }}" method="POST" class="register-form__content">
        @csrf

          {{--現在の体重--}}
          <div class="content">
            <p class="content-name">現在の体重</p>
            <input type="" name="" class="content-item" placeholder="現在の体重を入力" value="{{old('')}}">kg
          </div>
          @error('')
            <div class="error-message">{{ $message }}</div>
          @enderror

          {{--目標の体重--}}
          <div class="content">
            <p class="content-name">目標の体重</p>
            <input type="" name="" class="content-item" placeholder="目標の体重を入力" value="{{old('')}}">kg
          </div>
          @error('')
            <div class="error-message">{{ $message }}</div>
          @enderror

          <div class="register__button">
            <button 	class="register__button-submit" type="submit">アカウント作成</button>
          </div>
        </form>
      </div>
    
    </main>
</body>