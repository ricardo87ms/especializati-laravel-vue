<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public static function getResults($name = null)
    {
        if (!$name) {
            return self::get();
        }
        return self::where('name', 'LIKE', "%{$name}%")->get();
    }

    protected $fillable = ['name'];
}
