<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{ 
    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = ["id","name","available_quantity","price","description","image"];
} 
