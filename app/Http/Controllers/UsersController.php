<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->paginate(30);
        
        return view('users.index', [
            'users' => $users
        ]);
    }
    
    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show', [
            'user' => $user
        ]);
    }
    
    public function mypage(){
        
    }
    
    public function edit(){
        
    }
    
    public function update(){
        
    }
    
    public function destroy(){
        
    }
    
}
