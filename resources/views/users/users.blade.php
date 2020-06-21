
<div class="media mb-4 users">
    <p>ユーザーのアイコン画像</p>
    <div class="media-body ml-3">
        <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
        
        <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}</p>
        <p class="d-inline-block">コーディネート数</p>　
        <p class="d-inline-block">フォロワー数</p>
        <p>{{ $user->introduction }}</p>
        
        <button class="float-right mb-5 mr-4">フォロー</button>
    </div>
</div>
