<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    protected $table = 'orders_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function order(){
        return $this->hasOne('App\Models\orders','id','order_id');
    }
}
