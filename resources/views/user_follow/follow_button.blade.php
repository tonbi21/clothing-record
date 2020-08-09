@if (Auth::id() != $user->id) 
    @if(Auth::user()->is_following($user->id))
        <!--フォロー済み-->
        <button type="submit" class="btn btn-danger unfollow" id="follow-button-{{ $user->id }}" data-id="{{ $user->id }}">
             フォロー中
        </button>
    @else
        <!--フォローする-->
        <button type="submit" class="btn btn-primary follow" id="follow-button-{{ $user->id }}" data-id="{{ $user->id }}">
            フォローする
        </button>
    @endif
@endif



    