<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use App\User;
use App\Coordinate;
use Storage;
use Illuminate\Support\Facades\Validator;

class CoordinatesController extends Controller
{
    public function index(){
        $data = [];
        $coordinates = Coordinate::orderBy('id', 'desc')->paginate(99);
        
        // ここから東京の天気の変数
        
        $t_response = null;
        $t_url = 'https://api.openweathermap.org/data/2.5/weather?q=Tokyo&lang=ja&units=metric&appid=ec7cb73c7f4ecd56b0a6e86bec0b7bac';
        $t_response = json_decode(file_get_contents($t_url), true);
        
        //日時
        $t_datetime = new DateTime();
        $t_datetime->setTimestamp( $t_response['dt'] )->setTimeZone(new DateTimeZone('Asia/Tokyo')); // 日時 - 協定世界時 (UTC)を日本標準時 (JST)に変換
        $t_date =  $t_datetime->format('m/d'); //　日付
        $t_time = $t_datetime->format('H:i'); // 時間
        
        //天気
        $t_weather = $t_response['weather']['0']['main'];  //気象パラメータ
        $t_description = $t_response['weather']['0']['description'];  //気象詳細
        $t_icon = $t_response['weather']['0']['icon']; //アイコン
        
        //地域
        $t_name = $t_response['name'];
        
        //気温
        $t_temp = intval($t_response['main']['temp']);
        $t_temp_min = intval($t_response['main']['temp_min']);  //最低気温
        $t_temp_max = intval($t_response['main']['temp_max']);  //最高気温
        
        // ここまで東京の天気の変数
        
        
        // ここから大阪の天気の変数
        
        $o_response = null;
        $o_url = 'https://api.openweathermap.org/data/2.5/weather?q=Osaka&lang=ja&units=metric&appid=ec7cb73c7f4ecd56b0a6e86bec0b7bac';
        $o_response = json_decode(file_get_contents($o_url), true);
        
        
        //日時
        $o_datetime = new DateTime();
        $o_datetime->setTimestamp( $o_response['dt'] )->setTimeZone(new DateTimeZone('Asia/Tokyo')); // 日時 - 協定世界時 (UTC)を日本標準時 (JST)に変換
        $o_date =  $o_datetime->format('m/d'); //　日付
        $o_time = $o_datetime->format('H:i'); // 時間
        
        //天気
        $o_weather = $o_response['weather']['0']['main'];  //気象パラメータ
        $o_description = $o_response['weather']['0']['description'];  //気象詳細
        $o_icon = $o_response['weather']['0']['icon']; //アイコン
        
        //地域
        $o_name = $o_response['name'];
        
        //気温
        $o_temp = intval($o_response['main']['temp']);
        $o_temp_min = intval($o_response['main']['temp_min']);  //最低気温
        $o_temp_max = intval($o_response['main']['temp_max']);  //最高気温
        
        // ここまで大阪の天気の変数
        
    
        $data = [
                'coordinates' => $coordinates,
                
                //東京の天気に関する変数
                't_weather' => $t_weather,
                't_description' => $t_description,
                't_icon' => $t_icon,
                't_date' => $t_date,
                't_time' => $t_time,
                't_name' => $t_name,
                't_temp' => $t_temp,
                't_temp_min' => $t_temp_min,
                't_temp_max' => $t_temp_max,
                
                // 大阪の天気に関する変数
                'o_weather' => $o_weather,
                'o_description' => $o_description,
                'o_icon' => $o_icon,
                'o_date' => $o_date,
                'o_time' => $o_time,
                'o_name' => $o_name,
                'o_temp' => $o_temp,
                'o_temp_min' => $o_temp_min,
                'o_temp_max' => $o_temp_max,
            ];
           
        return view('welcome', $data);
        
    }
    
    public function show($id){
        $coordinate = Coordinate::find($id);
        
        return view('coordinates.show', [
            'coordinate' => $coordinate
        ]);
    }
    
    public function create(){
        $coordinate = new Coordinate;
        
         return view('coordinates.create', ['coordinate' => $coordinate]);
    }
    
    public function store(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10240|mimes:jpeg,gif,png',
            'coordinate_type' => 'required|integer',
            'content' => 'required|max:500'
        ]);
        
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        $file = $request->file('file');
        // dd($file);
        $path = Storage::disk('s3')->putFile('coordinates/'.\Auth::id(), $file, 'public');
        
        Coordinate::create([
            'user_id' => \Auth::user()->id,
            'coordinate_image_url' => $path,
            'content' => $request->content,
            'coordinate_type' => $request->coordinate_type
        ]);    
        
         return redirect('/users/' . \Auth::id());
            
    }
    
    public function edit(Coordinate $coordinate){
        return view('coordinates.edit', [
            'coordinate' => $coordinate
        ]);
    }
    
    public function update(Request $request, Coordinate $coordinate){
        $validator = Validator::make($request->all(), [
            'file' => 'max:10240|mimes:jpeg,gif,png',
            'coordinate_type' => 'required|integer',
            'content' => 'required|max:500'
        ]);
        
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        if($request->has('file')) {
            
            $file = $request->file('file');
            $path = Storage::disk('s3')->putFile('coordinates/'.$coordinate->id, $file, 'public');
            
            $coordinate->coordinate_image_url = $path;
        }
        
        $coordinate->coordinate_type = $request->coordinate_type;
        $coordinate->content = $request->content;
        $coordinate->save();
        
        return redirect('users/' . $coordinate->user->id);
    }
    
    public function destroy($id){
        $coordinate = \App\Coordinate::findOrFail($id);
        if (\Auth::id() === $coordinate->user_id) {
            $coordinate->delete();
        }
        
        return redirect('/users/' . \Auth::id());
    }
    
    public function coordinate_type(Request $request){
        $data = [];
        $query = Coordinate::orderBy('id', 'desc');
        if($request->has('coordinate_type')) {
            $query->where('coordinate_type', $request->input('coordinate_type'));
        }
        $coordinates = $query->paginate(99);
        $coordinate_type = $request->coordinate_type;
        $data = [
                'coordinates' => $coordinates,
                'coordinate_type' => $coordinate_type
            ];
            
        return view('coordinates.coordinate_type', $data);
    }
    
    public function gender(Request $request){
        $data = [];
        $query = Coordinate::orderBy('id', 'desc');
        if($request->has('gender')) {
            $query->whereHas('User', function($q) use($request){
                $q->where('gender', $request->input('gender'));
            });
        }
        
        $coordinates = $query->paginate(99);
        $gender = $request->gender;
        $data = [
                'coordinates' => $coordinates,
                'gender' => $gender
            ];
            
        return view('coordinates.gender', $data);
    }
    
  

    public function weather(){
        
        $response = null;
        
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=Tokyo&lang=ja&units=metric&appid=ec7cb73c7f4ecd56b0a6e86bec0b7bac';

        $params = [
            'format' => 'json',
            'applicationId' => 'ec7cb73c7f4ecd56b0a6e86bec0b7bac',
        ];
        
        $response = json_decode(file_get_contents($url), true);
        
        //日時
        $datetime = new DateTime();
        $datetime->setTimestamp( $response['dt'] )->setTimeZone(new DateTimeZone('Asia/Tokyo')); // 日時 - 協定世界時 (UTC)を日本標準時 (JST)に変換
        $date =  $datetime->format('m/d'); //　日付
        $time = $datetime->format('H:i'); // 時間
        
        //天気
        $weather = $response['weather']['0']['main'];  //気象パラメータ
        $description = $response['weather']['0']['description'];  //気象詳細
        $icon = $response['weather']['0']['icon']; //アイコン
        
        //地域
        $name = $response['name'];
        
        //気温
        $temp = intval($response['main']['temp']);
        $temp_min = intval($response['main']['temp_min']);  //最低気温
        $temp_max = intval($response['main']['temp_max']);  //最高気温
        
        
        return view('welcome', [
            'weather' => $weather,
            'description' => $description,
            'icon' => $icon,
            'date' => $date,
            'time' => $time,
            'name' => $name,
            'temp' => $temp,
            'temp_min' => $temp_min,
            'temp_max' => $temp_max,
        ]);
    }
}

