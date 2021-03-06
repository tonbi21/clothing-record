    <ul class="nav nav-pills nav-fill col-md-6 offset-md-1 col-12 p-0">
        
        <li class="nav-item">
            <a href="{{ route('users.show', ['user' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.show') ? 'btn btn-secondary' : 'btn btn-light' }}">
                <h5 class="font-weight-bold">{{ $user->coordinates_count }}</h5>
                コーディネート
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.myitems', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.myitems') ? 'btn btn-secondary' : 'btn btn-light' }}">
                <h5 class="font-weight-bold">{{ $user->items_count }}</h5>
                マイアイテム
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'btn btn-secondary' : 'btn btn-light' }}">
                <h5 class="font-weight-bold">{{ $user->favorites_count }}</h5>
                お気に入り
            </a>
        </li>
    </ul>
    
    
    <ul class="nav nav-pills nav-fill col-md-4 col-12 p-0">
        <li class="nav-item">
            <a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followings') ? 'btn btn-secondary' : 'btn btn-light' }}">
                <h5 class="font-weight-bold">{{ $user->followings_count }}</h5>
                フォロー
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.followers') ? 'btn btn-secondary' : 'btn btn-light' }}">
                <h5 class="font-weight-bold">{{ $user->followers_count }}</h5>
                フォロワー
            </a>
        </li>
    </ul>
    