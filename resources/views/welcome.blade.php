@extends('layouts.app')

@section('content')

    <!--東京と大阪の天気-->
    @include('coordinates.weather')
    
    <ul class="nav nav-pills nav-fill row mt-5 mb-5">
        <li class="nav-item col-lg-2 offset-lg-5 col-sm-4 offset-sm-2 col-6">
            <a class="nav-link btn btn-dark switching recommendation" href="#">おすすめ</a>
        </li>
        @if(Auth::check())
            <li class="nav-item col-lg-2 col-sm-4 col-6">
                <a class="nav-link btn btn-outline-secondary switching timeline" href="#">タイムライン</a>
            </li>
        @endif
    </ul>
    
    <div class="row">
        <!--サイドバー-->
        @include('users.side_bar')
        
        <div class="col-lg-8">
            <div class="row recommendation-switching">
                @foreach($coordinates as $coordinate)
                    <div class="col-md-4 col-6 mb-4">
                        <div class="card coordinate-card">
                            <a href="{{ route('coordinates.show', ['coordinate' => $coordinate->id]) }}">
                                <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                            </a>
                            <div class="card-body">
                                <div class="media">
                                    <!--ユーザーのアイコン-->
                                    <div class = "user-icon-coordinate">
                                        @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                                        @else
                                            <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="img-circle">
                                        @endif  
                                    </div>
                                    <div class="media-body ml-1">
                                        <h5 class="">{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
                                        <p>{{ $coordinate->user->getGenderLabel($coordinate->user->gender) }} ｜ {{ $coordinate->user->height }}cm</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    #{{ $coordinate->getCoordinateLabel($coordinate->coordinate_type) }}
                                    <div class="float-right">
                                        @if (Auth::check())
                                            @include('favorites.favorite_button')
                                        @endif
                                    </div>
                                    
                                </li>
                                
                            </ul>
                            
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="row d-none timeline-switching">
                @if(Auth::check())
                    @include('users.timeline')
                @endif
            </div>
            
        </div>
    </div>
@endsection