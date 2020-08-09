@extends('layouts.app')

@section('content')
    <ul class="nav nav-pills nav-fill row mt-5 mb-5">
        <li class="nav-item col-md-3 offset-md-5">
            <p class="nav-link btn btn-dark">{{ App\User::getGenderLabel($gender) }}</p>
        </li>
    </ul>
    
    <div class="row">
        <!--サイドバー-->
        @include('users.side_bar')
        
        <div class="col-md-8">
            <div class="row">
                @foreach($coordinates as $coordinate)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
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
                                    <div class="media-body ml-3">
                                        <h5 class="mt-0">{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
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
            
        </div>
        
       
    </div>
@endsection