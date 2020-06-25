<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Coordinate extends Model
{
    protected $fillable = ['coordinate_image_url', 'content', 'coordinate_type', 'user_id'];
    
    //この投稿を所有するユーザ。
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //コーディネートタイプラベルを定義
    public static $coordinate_types = [
            0 => 'Spring',
            1 => 'Summer',
            2 => 'Autumn',
            3 => 'Winter',
            ];
    
    //コーディネートタイプを取得
    public static function getCoordinateLabel($coordinate_code) {
        $ret = null;

        if (!empty(self::$coordinate_types[$coordinate_code])) {
            $ret = self::$coordinate_types[$coordinate_code];
        }

        return $ret;

    }
    
    
    
    
}
