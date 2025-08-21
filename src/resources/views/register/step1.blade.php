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
  {{--webフォント--}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>

<body>
  <main>
    
  <div class="register-page">

    <div class="register-form">

      <form action="{{ route('register.step1') }}" method="POST" class="register-form__content">
      @csrf

        <div class="tit">
          <h1 class="register-title">PiGLy</h1>
          <h2 class="register-subtitle">新規会員登録</h2>
          <p class="register-step">STEP1 アカウント情報の登録</p>
        </div>

        {{--お名前--}}
        <div class="content">
          <p class="content-name">お名前</p>
          <input type="name" name="name" class="content-item" placeholder="例:山田花子" value="{{old('name')}}">
        </div>
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror

        {{--メールアドレス--}}
        <div class="content">
          <p class="content-name">メールアドレス</p>
          <input type="email" name="email" class="content-item" placeholder="例:test@example.com" value="{{old('email')}}">
        </div>
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror

        {{--パスワード--}}
        <div class="content">
          <p class="content-name">パスワード</p>
          <input type="password" name="password" class="content-item" placeholder="例:hvydgjojfg790k">
        </div>
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="register__button">
          <button 	class="register__button-submit" type="submit">次に進む</button>
          <a href="/login" class="login__button">ログインはこちら</a>
        </div>
      </form>
    </div>
  </div>
  </main>
</body>