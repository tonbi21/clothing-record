<div class="widthMax pt-4 mb-5">
    <div class="row">
        
        <div class="media col-md-9 offset-md-2">
             <!--ユーザーのアイコン-->
            <div class="user_icon">
                <div class="user-icon-profile ml-3">
                    @if($user->user_image_url === 'images/initial-icon.jpeg')
                        <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                    @else
                        <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="img-circle">
                    @endif            
                </div>    

                <!--閲覧ページのユーザーがログインユーザーなら編集ボタン表示、それ以外のユーザーならフォローボタン表示-->
                <div class="text-center mb-4 mt-3 ml-3">
                    @if($user->id === Auth::id())
                        {!! link_to_route('users.edit', 'プロフィール編集', ['user' => $user->id], ['class' => 'btn btn-outline-secondary']) !!}
                    @else
                        @if(Auth::check())
                            @include('user_follow.follow_button')
                        @endif
                    @endif
                </div>
            </div>
            
            <div class="media-body ml-5">
                <h3>{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h3>
                <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}cm</p>
                <p>{!! nl2br($user->introduction) !!}</p>
            </div>
        </div>
    </div>
</div>