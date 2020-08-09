<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿をお気に入りする
        $favorite = \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        
        // jsonのレスポンス
        return response()->json($favorite);
    }
    
    
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿のお気に入りを外す
        $unfavorite = \Auth::user()->unfavorite($id);
        // jsonのレスポンス
        return response()->json($unfavorite);
    }
}
