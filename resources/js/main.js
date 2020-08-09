
// コーディネート投稿時のアイテム選択フォームの追加
$('#add-form').on('click', function(){
    $(".item-form").eq(0).clone().appendTo(".items");
})


// おすすめ投稿とタイムラインの切り替え
$('.switching').on('click', function(e){
    if($(this).hasClass('timeline')){
        
        e.preventDefault();
        
        // ナブの色を変える
        $('.timeline')
            .removeClass('btn-outline-secondary')
            .addClass('btn-dark');
        $('.recommendation')
            .removeClass('btn-dark')
            .addClass('btn-outline-secondary');
        
        // タイムラインを表示
        $('.timeline-switching')
            .removeClass('d-none');
        // おすすめを非表示
        $('.recommendation-switching')
            .addClass('d-none');
            
    }else if($(this).hasClass('recommendation')){
        
        e.preventDefault();
        
        // ナブの色を変える
        $('.recommendation')
            .removeClass('btn-outline-secondary')
            .addClass('btn-dark');
        $('.timeline')
            .removeClass('btn-dark')
            .addClass('btn-outline-secondary');
        
        // おすすめを表示
        $('.recommendation-switching')
            .removeClass('d-none');
        // タイムラインを非表示
        $('.timeline-switching')
            .addClass('d-none');
    }
});


// ajax通信
$(function(){
    // お気に入りボタン押した時の処理
    $('button').on('click', function(e) {

        // var id クリックしたボタンのコーディネートのidを代入
        var id = $(this).data('id');
        e.preventDefault();
        
        
        if($('#favorite-button-' + id).hasClass('favorite')){
            $.ajax({
                headers: {
                    // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // POSTだけではなく、GETのメソッドも呼び出せる
                type:'POST',
                
                
                // ルーティングで設定したURL
                url:'/coordinates/' + id + '/favorite', // 引数も渡せる
                
                dataType: 'json',
            }).done(function (results){
                // 成功したときのコールバック
                console.log("お気に入りボタンが押されました。");

                if(results === true){
                    $('#favorite-button-' + id)
                        .removeClass('favorite')
                        .addClass('unfavorite');
                        
                    $('#favorite-button-' + id)
                        .children()
                        .remove();
                    
                     $('#favorite-button-' + id)
                        .append('<i class="fas fa-bookmark fa-lg"></i>')
                }
            });
            
        }else if($('#favorite-button-' + id).hasClass('unfavorite')){
             $.ajax({
                headers: {
                    // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // POSTだけではなく、GETのメソッドも呼び出せる
                type:'POST',
                // ルーティングで設定したURL
                url:'/coordinates/' + id + '/unfavorite', // 引数も渡せる
                data: {"id":id,"_method": "DELETE"},
                dataType: 'json',
            }).done(function (results){
                // 成功したときのコールバック
                console.log("お気に入り解除ボタンが押されました。");

                if(results === true){
                    $('#favorite-button-' + id)
                        .removeClass('unfavorite')
                        .addClass('favorite');
                        
                    $('#favorite-button-' + id)
                        .children()
                        .remove();
                    
                     $('#favorite-button-' + id)
                        .append('<i class="far fa-bookmark fa-lg"></i>')
                }
            })
        }    
    });
    

    
    // フォローボタン押した時の処理
    $('button').on('click', function(e) {

        // var id クリックしたボタンのコーディネートのidを代入
        var id = $(this).data('id');
        e.preventDefault();
        
        
        if($('#follow-button-' + id).hasClass('follow')){
            $.ajax({
                headers: {
                    // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // POSTだけではなく、GETのメソッドも呼び出せる
                type:'POST',
                // ルーティングで設定したURL
                url:'/user/' + id + '/follow', // 引数も渡せる
                dataType: 'json',
                
            }).done(function (results){
                // 成功したときのコールバック
                console.log("フォローボタンが押されました。");

                if(results === true){
                    $('#follow-button-' + id)
                        .removeClass('follow btn-primary')
                        .addClass('unfollow btn-danger');
                        
                    $('#follow-button-' + id)
                        .text('フォロー中');
                }
            });
            
        }else if($('#follow-button-' + id).hasClass('unfollow')){
             $.ajax({
                headers: {
                    // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // POSTだけではなく、GETのメソッドも呼び出せる
                type:'POST',
                // ルーティングで設定したURL
                url:'/user/' + id + '/unfollow', // 引数も渡せる
                data: {"id":id,"_method": "DELETE"},
                dataType: 'json',
                
            }).done(function (results){
                // 成功したときのコールバック
                console.log("フォロー解除ボタンが押されました。");

                if(results === true){
                    $('#follow-button-' + id)
                        .removeClass('unfollow btn-danger')
                        .addClass('follow btn-primary');
                        
                    $('#follow-button-' + id)
                        .text('フォローする');
                }
            })
        }    
    });
    
});