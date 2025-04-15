<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function images()
    {
        return $this->hasMany(HouseImage::class);
    }
}
