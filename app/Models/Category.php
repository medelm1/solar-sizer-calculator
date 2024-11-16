<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function getAttribute($key)
    {
        return parent::getAttribute(\Illuminate\Support\Str::snake($key));
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute(\Illuminate\Support\Str::snake($key), $value);
    }

    public function appliances()
    {
        return $this->hasMany(Appliance::class, 'category_id');
    }
}
