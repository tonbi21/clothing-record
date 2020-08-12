@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <!--サイドバー-->
        @include('users.side_bar')
        
        <div class="col-lg-8 col-10 offset-1">
            @foreach($users as $user)
                @include('users.users')
            @endforeach
        </div>
        
        {{ $users->links() }}
    </div>


@endsection