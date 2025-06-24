<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'cat_id',
        'model',
        'year',
        'description',
        'price',
        'image',
        'availability'
    ];

    public $timestamps = false;

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'cat_id');
    }
}
