<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $fillable=[
        'image_name',
        'product_name',
        'created_by',
        'product_id',
    ];
}
