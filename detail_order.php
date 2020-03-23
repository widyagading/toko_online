<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_order extends Model
{
    protected $table = "detail_orders";
    protected $fillable = ["id_order","id_product","quantity"];

    public function order()
    {
        return $this->belongsTo("App\Order","id_order","id");
    }

    public function product()
    {
        return $this->belongsTo("App\Products","id_product","id");
    }
}