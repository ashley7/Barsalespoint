<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceTag extends Model
{
    protected $fillable = ['name','barcode','vip_price','normal_price'];
}
