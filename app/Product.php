<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';



    protected $fillable = [
        'thumbnail',
        'title',
        'description',
        'price'
       /* 'created_by',
        'updated_by'*/
    ];

}
