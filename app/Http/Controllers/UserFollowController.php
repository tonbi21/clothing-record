<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($id){
        // 認証済みユーザ（閲覧者）が、 idのユーザをフォローする
        $follow = \Auth::user()->follow($id);
        
        // jsonのレスポンス
        return response()->json($follow);
    }
    
    public function destroy($id){
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
        $unfollow = \Auth::user()->unfollow($id);
        
        // jsonのレスポンス
        return response()->json($unfollow);
    }
}


