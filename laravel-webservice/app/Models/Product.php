<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['category_id', 'name', 'description', 'image'];

    public static function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['description']))
            return self::with('categoria')->paginate($total);

        return self::with('categoria')->where(function ($query) use ($data) {
                    if (isset($data['filter'])) {
                        $filter = $data['filter'];
                        $query->where('name', $filter);
                        $query->orWhere('description', 'LIKE', "%{$filter}%");
                    }

                    if (isset($data['name']))
                        $query->where('name', $data['name']);

                    if (isset($data['description'])) {
                        $description = $data['description'];
                        $query->where('description', 'LIKE', "%{$description}%");
                    }
                })//->toSql();dd($results);
                ->paginate($total);
    }


    public function categoria()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
