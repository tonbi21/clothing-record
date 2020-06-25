<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->paginate(30);
       
        return view('users.index', [
            'users' => $users,
            
        ]);
    }
    
    public function show($id){
        $user = User::find($id);
        $user->loadRelationshipCounts();
        $coordinates = $user->coordinates()->orderBy('id', 'desc')->paginate(92);
        return view('users.show', [
            'user' => $user,
            'coordinates' => $coordinates
        ]);
    }
    
    
    public function edit(){
        
    }
    
    public function update(){
        
    }
    
    public function destroy(){
        
    }
    
    public function gender(){
        
    }
    
}
