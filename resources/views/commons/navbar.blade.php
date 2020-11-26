

<nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="/">
      <h1 class="title">Clothing Record</h1>
    </a>
    
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse justify-content-end" id="nav-bar">
    <ul class="navbar-nav">
        @if(Auth::check())
            <li class="nav-item dropdown text-right user-icon-navbar">
                <a href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <div class="user-icon-nav">
                        @if(Auth::user()->user_image_url === 'images/initial-icon.jpeg')
                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                        @else
                            <img src= "{{ Storage::disk('s3')->url(Auth::user()->user_image_url) }}" alt="user_icon" class="img-circle">
                        @endif   
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {!! link_to_route('users.show', 'マイページ', ['user' => Auth::id()], ['class' => 'dropdown-item']) !!}
                    {!! link_to_route('coordinates.create', '投稿', [], ['class' => 'dropdown-item']) !!}
                    {!! link_to_route('users.index', 'ユーザーを探す',[], ['class' => 'dropdown-item']) !!}
                    {!! link_to_route('users.edit', '設定', ['user' => Auth::id()], ['class' => 'dropdown-item']) !!}
                    <div class="dropdown-divider"></div>
                    {!! link_to_route('logout.get', 'ログアウト',[], ['class' => 'dropdown-item']) !!}
                </div>
            </li>
        @else
            <!--ログインしていない時に表示-->
            <li class="nav-item">
                {!! link_to_route('login', 'ログイン', ['class' => 'nav-link']) !!}
            </li>
            <li class="mr-3 ml-3">
                |
            </li>
            <li class="nav-item mr-3">
                {!! link_to_route('signup.get', '新規登録', ['class' => 'nav-link']) !!}
            </li>
        @endif
    </ul>
  </div>
</nav>