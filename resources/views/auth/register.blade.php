@extends('layouts.app')

@section('content')
<div class="jumbotron mt-5">
    
    <div class="row">
        <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
            <img src="images/closet.jpeg" alt="closet-image" class="closet-image">
        </div>
        
        <div class="col-lg-5 col-10 offset-1">
            <div class="text-center">
                <h1>Sign up</h1>
            </div>
            
            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'ユーザーネーム') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'アドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('gender', '性別') !!}
                    {!! Form::select('gender', App\User::$genders, 0, ['class' => 'form-control']) !!}
                </div>
                            
                <div class="form-group">
                    {!! Form::label('height', '身長') !!}
                    {!! Form::selectRange('height', 120, 250, 170, ['class' => 'form-control']) !!}
                </div>                

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
    
        
    

@endsection
