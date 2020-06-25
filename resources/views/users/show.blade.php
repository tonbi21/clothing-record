@extends('layouts.app')

@section('content')
<div class="widthMax pt-4">
    <div class="row">
        
        <div class="media col-md-9 offset-md-2">
             <!--ユーザーのアイコン-->
            <div class="user_icon">
                    
                @if($user->user_image_url === 'images/initial-icon.jpeg')
                    <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="show-icon">
                @else
                    <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="show-icon">
                @endif            
                
                
                <!--閲覧ページのユーザーがログインユーザーなら編集ボタン表示、それ以外のユーザーならフォローボタン表示-->
                <div class="mt-3">
                    @if($user->id === Auth::id())
                        <button class="float-right mb-5 mr-4">プロフィール編集</button>
                    @else
                        <button class="float-right mb-5 mr-4">フォロー</button>
                    @endif
                </div>
            </div>
            
            
            <div class="media-body ml-5">
                <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
                
                <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}</p>
                <p class="d-inline-block">コーディネート数</p>　
                <p class="d-inline-block">フォロワー数</p>
                <p>{{ $user->introduction }}</p>
                
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <ul class="nav nav-pills nav-fill mt-5 col-md-11 offset-md-1">
        <li class="nav-item">
            <a class="nav-link btn btn-secondary" href="#">コーディネート</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">お気に入り</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">フォロー</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">フォロワー</a>
        </li>
    </ul>
    
    <div class="create-coordinate offset-md-5 mt-5 mb-5">
        {!! link_to_route('coordinates.create', 'コーディネートを投稿', ['type' => 'button'], ['class' => 'btn btn-primary btn-lg']) !!}
    </div>
    
    <!--空白-->
    <div class="col-md-3 mt-5">
        
    </div>

    
    <!--投稿した画像-->
    
    @foreach($coordinates as $coordinate)
        <div class="col-md-3">
            <div class="card">
                <a href="{{ route('coordinates.show', ['coordinate' => $coordinate->id]) }}">
                    <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                </a>
                <div class="card-body">
                    <div class="media">
                        <!--ユーザーのアイコン-->
                        @if($user->user_image_url === 'images/initial-icon.jpeg')
                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="show-post-icon">
                        @else
                            <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="show-post-icon">
                        @endif  
                        <div class="media-body ml-3">
                            <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
                            <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}cm</p>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">#{{ $coordinate->getCoordinateLabel($coordinate->coordinate_type) }}</li>
                    <li class="list-group-item"><button>いいね</button></li>
                </ul>
                
            </div>
        
        </div>
    @endforeach
    
</div>



@endsection