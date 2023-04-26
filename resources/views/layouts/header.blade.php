<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}">
  <link rel="stylesheet" href="{{ asset('/css/header.css')  }}">
  @yield('css')
  <title>scene-scope</title>
</head>

<body>
  <header class="header">
    <div class="menu">
      <nav class="menu-nav" id="nav">
        <ul>
          <li><a href="{{ route('home') }}">ホーム</a></li>
          @guest
          <li><a href="/login">ログイン</a></li>
          <li><a href="/register">新規登録</a></li>
          @endguest
          @can('owner')
          <li><a href="/admin">劇団メニュー</a></li>
          @endcan
          @auth
          <li><a href="{{ route('mypage') }}">マイページ</a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="header_top_btn">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          @endauth
        </ul>
      </nav>
      <div class="menu-btn" id="menu">
        <span class="menu__line--top"></span>
        <span class="menu__line--middle"></span>
        <span class="menu__line--bottom"></span>
      </div>
      <script>
        const target = document.getElementById("menu");
        target.addEventListener('click', () => {
          target.classList.toggle('open');
          const nav = document.getElementById("nav");
          nav.classList.toggle('in');
        });
      </script>
    </div>
    <div class="title">
      <h1>SceneScope</h1>
    </div>
    <div class="search">
      <form action="{{ route('search') }}" method="get">
        @csrf
        <input type="text" name="input" placeholder="検索する">
      </form>
    </div>
  </header>
  <main>
    @yield('main')
  </main>
  <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>