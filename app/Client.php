<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
      'name', 'lastname', 'phone', 'email', 'address'
    ];
    public function sales()
    {
      return $this->hasMany('App\sale');
    }
}
