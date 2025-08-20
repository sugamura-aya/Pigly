<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pigly(auth)</title>
  {{--リセットCSS--}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  {{--auth.cssファイル呼び出し--}}
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}"/>
  {{--webフォント
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libertinus+Math&display=swap" rel="stylesheet">--}}
</head>

<body>
    <main>
    
      <h1 class="register-title">PiGLy</h1>
      <h2 class="register-subtitle">ログイン</h2>

      <div class="register-form">

        <form action="/login" method="POST" class="register-form__content">
        @csrf

          {{--メールアドレス--}}
          <div class="content">
            <p class="content-name">メールアドレス</p>
            <input type="email" name="email" class="content-item" placeholder="メールアドレスを入力" value="{{old('email')}}">
          </div>
          @error('email')
            <div class="error-message">{{ $message }}</div>
          @enderror

          {{--パスワード--}}
          <div class="content">
            <p class="content-name">パスワード</p>
            <input type="password" name="password" class="content-item" placeholder="パスワードを入力">
          </div>
          @error('password')
            <div class="error-message">{{ $message }}</div>
          @enderror

          <div class="register__button">
            <button 	class="register__button-submit" type="submit">ログイン</button>
            <a href="{{ route('/register/step1') }}" class="login__button">アカウント作成はこちら</a>
          </div>
        </form>
      </div>

    
    </main>
</body>