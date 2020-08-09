
@if(Auth::id() != $coordinate->user->id) 
    @if(Auth::user()->is_favorite($coordinate->id))
        <!--保存済み-->
        <button type="submit" class="btn btn-link unfavorite" id="favorite-button-{{ $coordinate->id }}" style="color: black;" data-id="{{ $coordinate->id }}">
             <i class="fas fa-bookmark fa-lg"></i>
        </button>
    @else
        <!--保存する-->
        <button type="submit" class="btn btn-link favorite" id="favorite-button-{{ $coordinate->id }}" style="color: black;" data-id="{{ $coordinate->id }}">
            <i class="far fa-bookmark fa-lg"></i>
        </button>
    @endif
@endif


