@extends('layouts.app')

@section('content')

    <div class='text-center mt-5 mb-2'>
        <h2>Weather</h2>
    </div>

    <div class="row">
        <div class="card mb-3 p-0 col-md-8 offset-md-2">
            <div class="row no-gutters">
                
                <!--大阪の天気-->
                <div class="col-md-6">
                    <a type="button" data-toggle="modal" data-target="#osakaModal">
                        <img src="images/osaka.jpg" class="card-img" alt="osaka-weather">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Osaka</h1>
                        </div>
                    </a>
                </div>
                
                <!--東京の天気-->
                <div class="col-md-6">
                    <a type="button" data-toggle="modal" data-target="#tokyoModal">
                        <img src="images/tokyo.jpg" class="card-img" alt="tokyo-weather">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Tokyo</h1>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    
    @include('coordinates.weather')
    

    <ul class="nav nav-pills nav-fill row mt-5 mb-5">
        <li class="nav-item col-md-2 offset-md-4">
            <a class="nav-link btn btn-dark" href="/">おすすめ</a>
        </li>
        <li class="nav-item col-md-2">
            <a class="nav-link btn btn-outline-secondary" href="#">タイムライン</a>
        </li>
    </ul>
    
    <div class="row">
        <div class="col-md-2 offset-md-1 frame categories">
            <h5>性別</h5>
            <ul>
                <li><a href="/">All</a></li>
                @foreach(App\User::$genders as $code => $gender)
                    <li>
                        <a href="{{route('gender.get', ['gender' => $code])}}">{{ $gender }}</a>
                    </li>
                @endforeach
            </ul>
            
            <h5>コーディネートタイプ</h5>
            <ul>
            @foreach(App\Coordinate::$coordinate_types as $code => $coordinate_type)
                <li>
                    <a href="{{route('coordinate_type.get', ['coordinate_type' => $code])}}">{{ $coordinate_type }}</a>
                </li>
            @endforeach
            </ul>
            
            <h5>ユーザーを探す</h5>
        </div>
        
        <div class="col-md-8">
            <div class="row">
                @foreach($coordinates as $coordinate)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="{{ route('coordinates.show', ['coordinate' => $coordinate->id]) }}">
                                <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                            </a>
                            <div class="card-body">
                                <div class="media">
                                    <!--ユーザーのアイコン-->
                                    
                                    @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                                        <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="show-post-icon">
                                    @else
                                        <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="show-post-icon">
                                    @endif  
                                    <div class="media-body ml-1">
                                        <h5 class="">{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
                                        <p>{{ $coordinate->user->getGenderLabel($coordinate->user->gender) }} ｜ {{ $coordinate->user->height }}cm</p>
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
            
        </div>
        
       
    </div>
@endsection