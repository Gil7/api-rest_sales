<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
      'name', 'description','price','quantity'
    ];
    public function sales()
    {
      return $this->belongsToMany('App\Sale','product_sale')->withPivot('quantity','price');
    }
}
