<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerPredict extends Model
{
    use HasFactory;

    public $table = 'computer_predict';
    public $timestamps = false;
    public $fillable = ['match_id', 'asia_predict', 'even_odd_predict', 'home_score', 'away_score'];
}
