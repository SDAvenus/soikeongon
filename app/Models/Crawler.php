<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'crawl';
    }


}
