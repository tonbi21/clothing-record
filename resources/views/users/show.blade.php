@extends('layouts.app')

@section('content')

@include('users.user_profile')

<div class="row">
    @include('users.nab_tabs')
    
    <div class="create-coordinate mt-5 mb-5 mx-auto">
        @if($user->id === Auth::id())
            {!! link_to_route('coordinates.create', 'コーディネートを投稿', ['type' => 'button'], ['class' => 'btn btn-primary btn-lg']) !!}
        @endif
    </div>
    
    <!--空白-->
    <div class="col-12">
    </div>

    <!--投稿した画像-->
    @foreach($coordinates as $coordinate)
        <div class="col-lg-3 col-md-4 col-sm-6 offset-sm-0 col-10 offset-1 mb-4">
            <div class="card">
                <a href="{{ route('coordinates.show', ['coordinate' => $coordinate->id]) }}">
                    <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                </a>
                <div class="card-body">
                    <div class="media">
                        <!--ユーザーのアイコン-->
                        <div class="user-icon-coordinate">
                            @if($user->user_image_url === 'images/initial-icon.jpeg')
                                <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                            @else
                                <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="img-circle">
                            @endif  
                        </div>
                        <div class="media-body ml-3">
                            <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
                            <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}cm</p>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        ＃{{ $coordinate->getCoordinateLabel($coordinate->coordinate_type) }}
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
@endsection