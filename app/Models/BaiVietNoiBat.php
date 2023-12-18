<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiVietNoiBat extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'post_noi_bat_home';
    }

    public static function getBaiVietNoiBat($category_id = '', $type = '', $limit = ''){
        $qb = self::with('post');
        if(!empty($category_id)) $qb->where('category_id', $category_id);
        if(!empty($type))
            $qb->where('type', $type);
        else
            $qb->whereNull('type');
        $qb->orderBy('order_by', 'DESC');
        if(!empty($limit)) $qb->limit($limit);

        return $qb->get();
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
