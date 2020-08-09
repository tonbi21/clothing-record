<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'height', 'user_image_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $genders = [
            0 => 'Men',
            1 => 'Woman',
            2 => 'Ather',
            ];
            
    public static function getGenderLabel($gender_code) {
        $ret = null;

        if (!empty(self::$genders[$gender_code])) {
            $ret = self::$genders[$gender_code];
        }

        return $ret;

    }
     
    //このユーザが所有する投稿。 
    public function coordinates(){
        return $this->hasMany(Coordinate::class);
    }
    
    //このユーザが所有するアイテム。 
    public function items(){
        return $this->hasMany(Item::class);
    }
  
    //このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
    public function followings() {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }        
    
    public function followers() {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    
    
    // このユーザーがお気に入りしている投稿
    public function favorites() {
        return $this->belongsToMany(Coordinate::class, 'favorites', 'user_id', 'coordinate_id')->withTimestamps();
    }
    
    
    //ユーザーに関するモデルの数を取得
    public function loadRelationshipCounts(){
        $this->loadCount(['coordinates', 'items', 'followings', 'followers', 'favorites']);
    }
    
    
    public function follow($userId){
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;
        
        if($exist || $its_me){
            // すでにフォローしていれば何もしない
            return false;
        }else{
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    } 
    
    public function unfollow($userId){
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me){
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        }else{
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId){
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_coordinates(){
        $userIds = $this->followings()->pluck('users.id')->toArray();
        $userIds[] = $this->id;
        return Coordinate::whereIn('user_id', $userIds);
    }
    
    
    public function favorite($coordinateId){
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($coordinateId);
        
        if($exist){
            // すでにお気に入りしていれば何もしない
            return false;
        }else{
            // まだお気に入りしてなければお気に入りする
            $this->favorites()->attach($coordinateId);
            return true;
        }
    }
    
    public function unfavorite($coordinateId){
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($coordinateId);
        
        if($exist){
            // すでにお気に入りしていればお気に入りをはずす。
            $this->favorites()->detach($coordinateId);
            return true;
        }else{
            // まだお気に入りしてなければ何もしない
            return false;
        }
    }
    
    public function is_favorite($coordinateId){
        return $this->favorites()->where('coordinate_id', $coordinateId)->exists();
    }
    
   
}
