@extends('layouts.app')

@section('content')
    <ul class="nav nav-pills nav-fill row mt-5 mb-5">
        <li class="nav-item col-md-3 offset-md-5">
            <p class="nav-link btn btn-dark">{{ App\User::getGenderLabel($gender) }}</p>
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
                            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                            <div class="card-body">
                                <div class="media">
                                    <!--ユーザーのアイコン-->
                                    
                                    @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                                        <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="show-post-icon">
                                    @else
                                        <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="show-post-icon">
                                    @endif  
                                    <div class="media-body ml-3">
                                        <h5 class="mt-0">{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
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