@extends('layouts.app')
@section('content')
<div class="jumbotron mt-5">
    <div class="row">
        <div class="col-6 col-lg-5 offset-lg-1">
            <img src="images/closet.jpeg" alt="closet-image" class="closet-image">
        </div>
        <div class="col-6 col-lg-5">
            <div class="text-center">
                <h1>Log in</h1>
            </div>
            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group mt-3">
                    {!! Form::label('email', 'アドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group mt-5">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Login', ['class' => 'btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
