
<div class="media mb-4 frame">
    
    <!--ユーザーのアイコン-->
    <div class="user-icon-user m-3">
        @if($user->user_image_url === 'images/initial-icon.jpeg')
            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
        @else
            <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="img-circle">
        @endif  
    </div>
    <div class="media-body ml-3 mt-3">
        <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
        
        <!--関係するモデルの件数をロード-->
        {{ $user->loadRelationshipCounts() }}
        
        <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}</p>
        <p class="d-inline-block">コーディネート数：{{ $user->coordinates_count }}</p>　
        <p class="d-inline-block">フォロワー数：{{ $user->followers_count }}</p>
        <p>{!! nl2br($user->introduction) !!}</p>
        
        <div class="float-right mr-5 mb-3">
            <!--フォローボタン-->
            @if(Auth::check())
                @include('user_follow.follow_button')
            @endif
            
        </div>
    </div>
</div>




