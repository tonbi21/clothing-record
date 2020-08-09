<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $fillable = [
        'user_id', 'item_image_url', 'brand', 'gender', 'category_id', 'name'
    ];
    
    //このアイテムを所有するユーザ。
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
     //このアイテムをを使っているコーディネート。
    public function coordinates()
    {
        return $this->belongsToMany(Coordinate::class, 'coordinate_item', 'item_id', 'coordinate_id');
    }
    
    
    //アイテムカテゴリーラベルを定義
    public static $item_category = [
            0 => 'トップス',
            1 => 'ジャケット/アウター',
            2 => 'パンツ',
            3 => 'オールインワン',
            4 => 'スカート',
            5 => 'ワンピース',
            6 => 'オールインワン',
            7 => 'バッグ',
            8 => 'シューズ',
            9 => 'ファッション雑貨',
            10 => 'その他'
            ];
    
    //コーディネートタイプを取得
    public static function getCategoryLabel($item_code) {
        $ret = null;

        if (!empty(self::$item_category[$item_code])) {
            $ret = self::$item_category[$item_code];
        }

        return $ret;

    }
    
    public static $genders = [
            0 => 'メンズ',
            1 => 'レディス',
            ];
            
    public static function getGenderLabel($gender_code) {
        $ret = null;

        if (!empty(self::$genders[$gender_code])) {
            $ret = self::$genders[$gender_code];
        }

        return $ret;

    }
    
}
