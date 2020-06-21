@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2 offset-md-1 search-category">
            <h2>性別</h2>
            <ul>
                <li>All</li>
                <li>Men</li>
                <li>Woman</li>
                <li>Ather</li>
            </ul>
        </div>
        
        <div class="col-md-8">
            @foreach($users as $user)
                @include('users.users')
            @endforeach
        </div>
        
        {{ $users->links() }}
    </div>


@endsection