@extends('layouts.app')

@section('content')
<div class="widthMax p-3">
    <div class="row">
        <div class="media offset-md-2 col-md-8">
            <a href="{{ route('users.show', ['user' => $coordinate->user->id]) }}">
                
                @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                    <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="show-post-icon">
                @else
                    <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="show-post-icon">
                @endif
            </a>
            <div class="media-body ml-3">
                <h5>{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
                <p>{{ $coordinate->user->getGenderLabel($coordinate->user->gender) }}</p>
            </div>
            @if(Auth::id() === $coordinate->user->id)
               {!! link_to_route('coordinates.edit', 'コーディネート編集', ['coordinate' => $coordinate->id], ['class' => 'btn btn-dark']) !!}
            @else
                <a href="#" class="btn btn-primary mt-1 pr-4 pl-4">フォロー</a>
            @endif
             
        </div>
    </div>
</div>
    <div class="row mt-5">
        <div class="col-md-6 offset-md-1">
            <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square-show">
        </div>
        <div class="col-md-5">
            <div class="frame p-4">
                <h4>{{ $coordinate->user->name }}のコーディネート</h4>
                <p>モデル情報： {{ $coordinate->user->height }}cm / {{ $coordinate->user->getGenderLabel($coordinate->user->gender) }}</p>
                <hr>
                <p>{{  $coordinate->content }}</p>
                <hr>
                <p>{{ $coordinate->created_at->format('Y/m/d H:i:s') }}</p>
            </div>
            <div class="frame p-4 mt-5">
                <h4 class="mb-5">着用アイテム（アイテム数）</h4>
                <div class="media">
                    <img src="..." class="mr-3" alt="アイテム画像">
                    <div class="media-body">
                        <h5 class="mt-0">アイテム名</h5>
                        <p>アイテムカテゴリー</p>
                    </div>
                    <hr>
                </div>
                <hr>
                <div class="media">
                    <img src="..." class="mr-3" alt="アイテム画像">
                    <div class="media-body">
                        <h5 class="mt-0">アイテム名</h5>
                        <p>アイテムカテゴリー</p>
                    </div>
                </div>
                <hr>
                <div class="media">
                    <img src="..." class="mr-3" alt="アイテム画像">
                    <div class="media-body">
                        <h5 class="mt-0">アイテム名</h5>
                        <p>アイテムカテゴリー</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

@endsection