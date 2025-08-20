<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pigly(WeightLogs)</title>
  {{--リセットCSS--}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  {{--common.css呼び出し--}}
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  {{--ページネーションの表示調整のため導入
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
  {{--weightlog.cssファイル呼び出し--}}
  <link rel="stylesheet" href="{{ asset('css/weightlog.css') }}"/>
  {{--webフォント
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libertinus+Math&display=swap" rel="stylesheet">--}}
</head>

<body>
    <header class="header">
        <div class="header__inner">PiGLy</div>
    
      <nav class="header__nav">
        <a class="nav__item" href="{{ route('weight_logs.goal.form') }}">目標体重設定</a>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
          @csrf
          <button class="nav__item" type="submit">ログアウト</button>
        </form>
      </nav>
    </header>

    <main>
    @yield('content')
    </main>


</body>