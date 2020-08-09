<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Storage;
use Illuminate\Support\Facades\Validator;

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
        $coordinates = $user->coordinates()->orderBy('id', 'desc')->paginate(60);
        return view('users.show', [
            'user' => $user,
            'coordinates' => $coordinates
        ]);
    }
    
    public function myitems($id){
        $user = User::find($id);
        $user->loadRelationshipCounts();
        $items = $user->items()->orderBy('id', 'desc')->paginate(60);
        return view('users.myitems', [
            'user' => $user,
            'items' => $items
        ]);
    }
    
    
    public function edit(User $user){
        return view('users.edit', [
            'user' => $user
        ]);
    }
    
    public function update(Request $request, User $user){
        // dd($request->introduction);
        $validator = Validator::make($request->all(), [
            'file' => 'max:10240|mimes:jpeg,gif,png',
            'name' => 'required|max:255',
            'gender' => 'required|integer',
            'height' => 'required|integer',
            'introduction' => 'max:255',
            ]);
        
            
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        if($request->has('file')) {
            
            $file = $request->file('file');
            $path = Storage::disk('s3')->putFile('clore-user/'.$user->id, $file, 'public');
            $user->user_image_url = $path;
        }
        
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->height = $request->height;
        $user->introduction = $request->introduction; 
        
        $user->save();
        
        return redirect('users/' . $user->id);
    }
    
    public function withdrawal(User $user){
        return view('users.withdrawal', [
            'user' => $user,
        ]);
    }
    
    public function destroy(User $user){
        $coordinates = $user->coordinates();
        $items = $user->items();
        
        $dir_user = 'clore-user/' . $user->id;
        $dir_coordinates = 'coordinates/' . $user->id;
        $dir_items = 'items/' . $user->id;
        
        $disk = Storage::disk('s3');
        
        if(\Auth::id() === $user->id){
            $coordinates->delete();
            $disk->deleteDirectory($dir_coordinates);
            $items->delete();
            $disk->deleteDirectory($dir_items);
            $user->delete();
            $disk->deleteDirectory($dir_user);
            
        }
        
        return redirect('/');
    }
    
    public function followings($id) {
        $user = User::find($id);
        $user->loadRelationshipCounts();
        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(30);
        
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    public function followers($id){
        $user = User::find($id);
        $user->loadRelationshipCounts();
        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(30);
        
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function favorites($id) {
        $user = User::find($id);
        $user->loadRelationshipCounts();
        // ユーザのフォロワー一覧を取得
        $favorites = $user->favorites()->paginate(60);
        
        return view('users.favorites', [
            'user' => $user,
            'coordinates' => $favorites,
        ]);
    }
    
   
    
    
    
}
