@extends('layouts.app')

@section('content')
    
    <div class="row mt-5">
        <!--サイドバー-->
        @include('users.side_bar')
        
        <div class="col-md-8">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="{{ route('items.show', ['item' => $item->id]) }}">
                                <img src= "{{ Storage::disk('s3')->url($item->item_image_url) }}" alt="coordinate-image" class="img-square">
                            </a>
                            <div class="card-body">
                                <div class="media">
                                    <!--ユーザーのアイコン-->
                                    <div class = "user-icon-coordinate">
                                        @if($item->user->user_image_url === 'images/initial-icon.jpeg')
                                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                                        @else
                                            <img src= "{{ Storage::disk('s3')->url($item->user->user_image_url) }}" alt="user_icon" class="img-circle">
                                        @endif  
                                    </div>
                                    <div class="media-body ml-1">
                                        <h5 class="">{!! link_to_route('users.show', $item->user->name, ['user' => $item->user->id]) !!}</h5>
                                        <p>{{ $item->user->getGenderLabel($item->user->gender) }} ｜ {{ $item->user->height }}cm</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">#{{ $item->getCategoryLabel($item->category_id) }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
        
       
    </div>    


@endsection