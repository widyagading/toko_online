<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $primaryKey = "id_order";
    protected $fillable = ["id","id_alamat","total","bukti_bayar","status"];

    public function user()
    {
        return $this->belongsTo("App\User","id_order","id");
    }

    public function alamat()
    {
        return $this->belongsTo("App\Alamat","id_alamat","id");
    }

    public function detail_order()
    {
        return $this->hasMany("App\detail_order","id_order");
    }
}