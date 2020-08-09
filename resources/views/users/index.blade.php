@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <!--サイドバー-->
        @include('users.side_bar')
        
        <div class="col-lg-8">
            @foreach($users as $user)
                @include('users.users')
            @endforeach
        </div>
        
        {{ $users->links() }}
    </div>


@endsection