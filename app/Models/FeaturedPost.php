<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedPost extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['post_id', 'order'];
    public $table = 'featured_post';
    
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
