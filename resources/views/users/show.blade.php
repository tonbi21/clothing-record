@extends('layouts.app')

@section('content')
<div class="widthMax">
    <div class="row">
        
        <div class="media mb-4 col-md-9 offset-md-2">
            <p>ユーザーのアイコン画像</p>
            @if($user->id === Auth::id())
                <button class="float-right mb-5 mr-4">プロフィール編集</button>
            @else
                <button class="float-right mb-5 mr-4">フォロー</button>
            @endif
            <div class="media-body ml-3">
                <h5 class="mt-0">{!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}</h5>
                
                <p>{{ $user->getGenderLabel($user->gender) }} ｜ {{ $user->height }}</p>
                <p class="d-inline-block">コーディネート数</p>　
                <p class="d-inline-block">フォロワー数</p>
                <p>{{ $user->introduction }}</p>
                
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <ul class="nav nav-pills nav-fill mt-5 col-md-11 offset-md-1">
        <li class="nav-item">
            <a class="nav-link active" href="#">コーディネート</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">お気に入り</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">フォロー</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">フォロワー</a>
        </li>
    </ul>


    <div class="col-md-3">
        コーディネート画像が入る
    </div>
</div>



@endsection