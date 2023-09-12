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
    <div class="header__item">
      <h1 class="header__title"><a href="{{ route('home') }}">Scene Scope</a></h1>
    </div>
    <div class="header__item">
      <div class="header__menu">
        <nav class="menu-nav" id="nav">
          <ul>
            <li><a href="{{ route('home') }}">ホーム</a></li>
            <li><a href="{{ route('performance.all') }}">公演を探す</a></li>
            <li><a href="{{ route('company.all') }}">劇団を探す</a></li>
            @guest
            <li><a href="/login">ログイン</a></li>
            <li><a href="/register">新規登録</a></li>
            @endguest
            @can('owner')
            <li><a href="{{ route('owner') }}">管理メニュー</a></li>
            @endcan
            @can('admin')
            <li><a href="{{ route('admin') }}">管理メニュー</a></li>
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
            <li><a href="https://forms.gle/8u3djzcrQvio65tM7">お問い合わせ</a></li>
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
    </div>
  </header>
  <main>
    @yield('main')
  </main>
</body>

</html>