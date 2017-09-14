<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
      'client_id'
    ];
    public function client($value='')
    {
      return $this->belongsTo('App\Client');
    }
    public function products()
    {
      return $this->belongsToMany('App\Product','product_sale')->withPivot('quantity');
    }
}
