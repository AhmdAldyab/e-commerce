<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable=[
        'product_name',
        'description',
        'price',
        'Created',
        'section_id'
    ];
    public function section()
    {
        return $this->belongsTo('App\Sections');
    }
    public function image()
    {
        return $this->hasMany('App\images');
    }
    
}
