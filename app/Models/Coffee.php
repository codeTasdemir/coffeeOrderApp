<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coffee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'catId',
        'desc',
        'image',
    ];

    protected $casts = [
        'milks'=>'array',
        'sugars'=>'array',
        'syrups'=>'array',
        'sizes'=>'array',
    ];

    public function category(){
        return $this->belongsTo(CoffeeCategory::class,'catId','id');
    }

}
