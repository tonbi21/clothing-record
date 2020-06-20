<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <a class="navbar-brand" href="#">
      <h1 class="title">Clore</h1>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if(Auth::check())
      <!--ログイン中に表示-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ユーザーアイコン
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">マイページ</a>
            <a class="dropdown-item" href="#">タイムライン</a>
            <a class="dropdown-item" href="#">設定</a>
            <div class="dropdown-divider"></div>
            
            {!! link_to_route('logout.get', 'ログアウト', ['class' => 'dropdown-item']) !!}
          </div>
        </li>
      @else
      <!--ログインしていない時に表示-->
        <li class="nav-item">
          {!! link_to_route('login.get', 'ログイン', ['class' => 'nav-link']) !!}
        </li>
        
        <li class="nav-item">
          {!! link_to_route('signup.get', '新規登録', ['class' => 'nav-link']) !!}
        </li>
      @endif
      
      
    </ul>
    
  </div>
</nav>