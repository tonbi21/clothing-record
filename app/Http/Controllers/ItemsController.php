<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Coordinate;
use App\Item;
use Storage;
use Illuminate\Support\Facades\Validator;


class ItemsController extends Controller
{
    public function index(){
        $items = Item::orderBy('id', 'desc')->paginate(99);
        
        return view('items.index', [
            'items' => $items
        ]);
    }
    
    public function show($id){
        $item = Item::find($id);
        $user = $item->user;
        return view('items.show', [
            'item' => $item,
            'user' => $user,
        ]);
    }
    
    public function create(){
        //$item = new Item;
        return view('items.create');
    }
    
    public function store(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10240|mimes:jpeg,gif,png',
            'gender' => 'required|integer',
            'brand' => 'required|max:30',
            'category_id' => 'required|integer',
            'name' => 'required|max:500',
        ]);
        
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        $file = $request->file('file');
        // dd($file);
        $path = Storage::disk('s3')->putFile('items/'.\Auth::id(), $file, 'public');
        
        Item::create([
            'user_id' => \Auth::user()->id,
            'item_image_url' => $path,
            'brand' => $request->brand,
            'gender' => $request->gender,
            'category_id' => $request->category_id,
            'name' => $request->name,
        ]);    
        
         return redirect('/users/' . \Auth::id() . '/myitems');
    }
    
    public function edit(Item $item){
        return view('items.edit', [
            'item' => $item
        ]);
    }
    
    public function update(Request $request, Item $item){
        $validator = Validator::make($request->all(), [
            'file' => 'max:10240|mimes:jpeg,gif,png',
            'gender' => 'required|integer',
            'brand' => 'required|max:30',
            'category_id' => 'required|integer',
            'name' => 'required|max:500',
        ]);
        
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        if($request->has('file')) {
            
            $file = $request->file('file');
            $path = Storage::disk('s3')->putFile('items/'.\Auth::id(), $file, 'public');
            
            $item->coordinate_image_url = $path;
        }
        
       $item->gender = $request->gender;
       $item->brand = $request->brand;
       $item->category_id = $request->category_id;
       $item->name = $request->name;
       $item->save();
        
        return redirect('items/' . $item->id);
    }
    
    public function destroy($id){
         $item = \App\Item::findOrFail($id);
        if (\Auth::id() === $item->user_id) {
            $item->delete();
        }
        
        return redirect('/users/' . \Auth::id());
    }
}
