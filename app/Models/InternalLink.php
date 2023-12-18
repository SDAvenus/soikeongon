<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalLink extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = 'internal_link';
    }

    public static function updateData($id, $content) {
        self::where('post_id', $id)->delete();
        preg_match_all('/href="(.*?)"/', $content, $match);
        foreach ($match[1] as $link) {
            if (preg_match('/^((.*?)soikeongon|\/)(.*?)-p([0-9]+)\.html/', $link, $m)) {
                $post_id_out = end($m);
                self::insert(['post_id' => $id, 'post_id_out' => $post_id_out]);
            }
        }
    }
}
