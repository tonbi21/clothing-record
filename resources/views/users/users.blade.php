
<div class="media mb-4 frame">
    
    <!--ユーザーのアイコン-->
    @if($user->user_image_url === 'images/initial-icon.jpeg')
        <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="users-icon m-3">
    @else
        <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="users-icon m-3">
    @endif  
    <div class="media-body ml-3">
        <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
        
        <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}</p>
        <p class="d-inline-block">コーディネート数</p>　
        <p class="d-inline-block">フォロワー数</p>
        <p>{{ $user->introduction }}</p>
        
        <button class="float-right mb-5 mr-4">フォロー</button>
    </div>
</div>




