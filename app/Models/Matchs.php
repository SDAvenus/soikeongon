<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{
    public $timestamps = false;
    public $fillable = ['scheduled', 'tournament', 'team_home_name', 
                        'team_home_logo', 'team_away_name', 'team_away_logo', 
                        'hdc_asia', 'hdc_eu', 'hdc_tx', 
                        'id_bongdalu', 'crawl_status'];

    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'match';
    }

    public function hasPost()
    {
        return $this->hasOne(Post::class, 'id_bongdalu', 'id_bongdalu');
    }

    function reset_match_pending_crawl(){
        return self::where('scheduled', '>=', self::raw('NOW() - INTERVAL 3 HOUR'))
            ->where('crawl_status', '!=', 'none')
            ->update(['crawl_status' => 'pending']);
    }

    function update_match_done_crawl(){
        return self::where('scheduled', '<=', self::raw('NOW() - INTERVAL 2 DAY'))
            ->where('crawl_status', 'pending')
            ->update(['crawl_status' => 'done']);
    }
}
