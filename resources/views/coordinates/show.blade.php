@extends('layouts.app')

@section('content')
    <div class="widthMax p-3">
        <div class="row">
            <div class="media offset-md-2 col-md-8">
                <div class="user-icon-user-tab">
                    <a href="{{ route('users.show', ['user' => $coordinate->user->id]) }}">
                        @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                        @else
                            <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="img-circle">
                        @endif
                    </a>
                </div>
                <div class="media-body ml-3 mt-3">
                    <h5>{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
                    <p>{{ $coordinate->user->getGenderLabel($coordinate->user->gender) }}</p>
                </div>
                <div class="mt-3">
                    @if(Auth::id() === $coordinate->user->id)
                       {!! link_to_route('coordinates.edit', 'コーディネート編集', ['coordinate' => $coordinate->id], ['class' => 'btn btn-dark']) !!}
                    @else
                        @if(Auth::check())
                            @include('user_follow.follow_button')
                        @endif
                    @endif
                </div> 
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <!--外面幅lg以上-->
        <div class="col-lg-6 offset-lg-1 d-none d-lg-block">
            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square-show-lg">
        </div>
        <!--画面幅md-->
        <div class="col-sm-8 offset-sm-2 d-none d-sm-block d-lg-none">
            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square-show-sm">
        </div>
        <!--外面幅md未満-->
        <div class="col-10 offset-1 d-block d-sm-none">
            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square-show">
        </div>
        
        <div class="col-lg-4 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1 mb-5">
            <div class="frame p-4">
                <h4>{{ $coordinate->user->name }}のコーディネート</h4>
                <p>モデル情報： {{ $coordinate->user->height }}cm / {{ $coordinate->user->getGenderLabel($coordinate->user->gender) }}</p>
                <hr>
                <p>{!! nl2br($coordinate->content) !!}</p>
                <hr>
                <p>
                    <!--ログインユーザーならお気に入りボタン表示-->
                    @if (Auth::check())
                        @include('favorites.favorite_button')
                    @endif
                    
                    <!--お気に入りの数が０でなければ表示-->
                    @if($coordinate->favorite_users_count !== 0)
                        {{ $coordinate->favorite_users_count }}人のユーザーがお気に入り
                    @endif
                </p>
                
                <p class="float-right">{{ $coordinate->created_at->format('Y/m/d H:i') }}</p>
            </div>
            
            <div class="frame p-4 mt-5">
                <h4 class="mb-5">着用アイテム（{{ $coordinate->items_count }}）</h4>
                @foreach($items as $item)
                    <div class="media">
                        <a href="{{ route('items.show', ['item' => $item->id]) }}">
                            <img src= "{{ Storage::disk('s3')->url($item->item_image_url) }}" alt="アイテム画像" class="wearing-item">
                        </a>
                        <div class="media-body ml-3">
                            <h4>{{ $item->brand }}</h4>
                            <p>{{ $item->name }}</p>
                            <p>{{ $item->getCategoryLabel($item->category_id) }}</p>
                        </div>
                        <hr>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection