@extends('layouts.app')

@section('content')
    <div class="center jumbotron p-5">
        <div class="row">
            <div class="col-md-6">
                <img src="images/closet.jpeg" alt="トップページイメージ" class="w-100">
            </div>
            <div class="col-md-4 offset-md-1">
                <h3 class="mb-5 text-center">ログイン</h3>
                {!! Form::open(['route' => 'login.post']) !!}
                    
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="text-center mt-5">
                        {!! Form::submit('ログイン', ['class' => 'btn btn-primary']) !!}
                        <div class="mt-5">
                            {!! link_to_route('signup.get', '初めてご利用の方（新規会員登録）', ['class' => 'nav-link']) !!}
                        </div>
                    </div>
                    
                    
            </div>
            
        </div>
    </div>


@endsection