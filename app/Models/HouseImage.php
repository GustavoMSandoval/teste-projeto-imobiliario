<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseImage extends Model
{
    protected $fillable = [
        'image_path', 
        'house_id'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
