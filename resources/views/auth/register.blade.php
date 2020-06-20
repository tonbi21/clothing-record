@extends('layouts.app')

@section('content')
    <div class="center jumbotron p-5">
        <div class="row">
            <div class="col-md-6">
                <img src="images/closet.jpeg" alt="トップページイメージ" class="w-100">
            </div>
            <div class="col-md-4 offset-md-1">
                <h3 class="mb-5 text-center">新規会員登録</h3>
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'ユーザーネーム') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワードの確認') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('gender', '性別') !!}
                        {!! Form::select('gender', App\User::$genders, 1, ['class' => 'form-control']) !!}
                    </div>
                    
                    
                    <div class="form-group">
                        {!! Form::label('height', '身長') !!}
                        {!! Form::selectRange('height', 120, 250, 170, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="text-center mt-5">
                        {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
                    </div>
                    
                    <div>
                        <a href="#">ログインページへのリンク</a>
                    </div>
                    
            </div>
            
        </div>
    </div>


@endsection