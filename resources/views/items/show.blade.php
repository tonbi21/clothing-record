@extends('layouts.app')

@section('content')
    <div class="widthMax p-3">
        <div class="row">
            <div class="media offset-md-2 col-md-8">
                <div class="user-icon-user-tab">
                    <a href="{{ route('users.show', ['user' => $item->user->id]) }}">
                        @if($item->user->user_image_url === 'images/initial-icon.jpeg')
                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                        @else
                            <img src="{{ Storage::disk('s3')->url($item->user->user_image_url) }}" alt="user_icon" class="img-circle">
                        @endif
                    </a>
                </div>
                <div class="media-body ml-3 mt-3">
                    <h5>{!! link_to_route('users.show', $item->user->name, ['user' => $item->user->id]) !!}</h5>
                    <p>{{ $item->user->getGenderLabel($item->user->gender) }}</p>
                </div>
                <div class="mt-3">
                    @if(Auth::id() === $item->user->id)
                       {!! link_to_route('items.edit', 'アイテム編集', ['item' => $item->id], ['class' => 'btn btn-dark']) !!}
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
            <img src= "{{ Storage::disk('s3')->url($item->item_image_url) }}" alt="item-image" class="img-square-show-lg">
        </div>
        <!--画面幅md-->
        <div class="col-sm-8 offset-sm-2 d-none d-sm-block d-lg-none">
            <img src= "{{ Storage::disk('s3')->url($item->item_image_url) }}" alt="item-image" class="img-square-show-sm">
        </div>
        <!--外面幅md未満-->
        <div class="col-10 offset-1 d-block d-sm-none">
            <img src= "{{ Storage::disk('s3')->url($item->item_image_url) }}" alt="item-image" class="img-square-show">
        </div>
        
        
        <div class="col-lg-4 offset-lg-0 col-md-6 col-md-8 offset-md-2 col-10 offset-1 mb-5">
            <div class="frame p-4">
                
                <p>ブランド：{{ $item->brand }}</p>
                <h4>{{ $item->name }}</h4>
            </div>
            <div class="frame p-4 mt-5">
                <h5 class="mb-3">アイテム詳細</h5>
                <p>カテゴリー：{{ $item->getCategoryLabel($item->category_id) }}</p>
                <p>性別：{{ $item->user->getGenderLabel($item->gender) }}</p>
            </div>
        </div>
    </div>
@endsection