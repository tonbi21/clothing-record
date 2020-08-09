@extends('layouts.app')

@section('content')
    
    <!--ユーザーのプロフィール-->
    @include('users.user_profile')
    
    
    <div class="row">
        @include('users.nab_tabs')
        
        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12 mt-5">
            @foreach($users as $user)
                @include('users.users')
            @endforeach
        </div>
    </div>
@endsection