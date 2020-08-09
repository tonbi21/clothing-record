@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-md-3">
            {!! link_to_route('users.edit', 'プロフィール変更', ['user' => $user->id], ['class' => 'nav-link btn btn-dark mb-5']) !!}
            {!! link_to_route('users.withdrawal', '退会について', ['user' => $user->id], ['class' => 'nav-link btn btn-secondary mb-5']) !!}
        </div>
        
        <!--ユーザー編集フォーム-->
        <div class="col-md-8">
            {!! Form::open(['route' => ['users.update', ['user' => $user->id]], 'method' => 'put', 'files' => true]) !!}
                <div class="card">
                    <div class="card-header">
                        基本情報
                    </div>
                    <div class ="p-5">
                        <div class="card-body">
                            <div class="form-group mb-4">
                                {!! Form::label('file', 'アイコン') !!}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="user-icon-edit">
                                            @if($user->user_image_url === 'images/initial-icon.jpeg')
                                                <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                                            @else
                                                <img src= "{{ Storage::disk('s3')->url($user->user_image_url) }}" alt="user_icon" class="img-circle">
                                            @endif  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4">
                                        {!! Form::file('file', ['class' => 'form-controll w-100']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                {!! Form::label('name', 'ユーザーネーム') !!}
                                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group mb-4">
                                {!! Form::label('gender', '性別') !!}
                                {!! Form::select('gender', App\User::$genders, $user->gender, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('height', '身長') !!}
                                {!! Form::selectRange('height', 120, 250, $user->height, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        自己紹介
                    </div>
                    <div class="p-5">
                        <div class="card-body">
                            {!! Form::textarea('introduction', $user->introduction, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    {!! Form::submit('編集', ['class' => 'btn btn-primary col-2 offset-5 mb-5']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        
    
@endsection