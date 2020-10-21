<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
protected $table = 'products';
protected $fillable = ['price', 'name', 'slug', 'description', 'user']; 
public $timestamps = true;

}
