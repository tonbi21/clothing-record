 @extends('layouts.app')
    @section('content')
    
     <div class="row mt-5">
        <!--編集ページと退会ページの切り替え-->
        <div class="col-md-3">
            <div class="row">
            <div class="col-lg-12 col-6">   
                {!! link_to_route('users.edit', 'プロフィール変更', ['user' => $user->id], ['class' => 'nav-link btn btn-secondary mb-5']) !!}
            </div>     
            <div class="col-lg-12 col-6">
                {!! link_to_route('users.withdrawal', '退会について', ['user' => $user->id], ['class' => 'nav-link btn btn-dark mb-5']) !!}
            </div>
            </div>
        </div>
        
        
         <!--ユーザー退会フォーム-->
        <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">
                        本当に退会しますか？
                    </div>
                    <div class ="p-4">
                        <div class="card-body">
                            退会をご希望される場合は、下記の注意事項に同意の上退会してください。
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        ご注意事項
                    </div>
                    <div class="p-4">
                        <div class="card-body">
                            <p>・退会処理後は同じアカウントのご利用ができなくなります。</p>
                            <p>・退会処理を行った場合、友達検索結果に表示されなくなり、ID・プロフィールも他のユーザーから閲覧できなくなります。</p>
                        </div>
                    </div>
                    <!--退会ボタン-->
                    {!! Form::open(['route' => ['users.destroy', 'user' => $user->id], 'method' => 'delete']) !!}
                        {!! Form::submit('退会', ['class' => 'btn btn-danger col-2 offset-5 mb-5']) !!}
                    {!! Form::close() !!}
                    
                    
                </div>
            
        </div>
        
    </div>
    @endsection
        
    