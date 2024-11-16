<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    protected $table = 'appliances';
    protected $fillable = ['name', 'power_rating', 'usage_hours', 'units', 'category_id'];

    public function getAttribute($key)
    {
        return parent::getAttribute(\Illuminate\Support\Str::snake($key));
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute(\Illuminate\Support\Str::snake($key), $value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
