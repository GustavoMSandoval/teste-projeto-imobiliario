<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseAddress extends Model
{
    protected $fillable = [
        'cep',
        'rua',
        'bairro',
        'cidade',
        'estado',
        'house_id',
    ];

    public function house() {
        return $this->belongsTo(House::class);
    }
}
