<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	protected $table = 'invoice_user';
    protected $fillable = ['name','email','refrencing'];

   public function orders()
    {
        return $this->hasMany('App\Orders');
    }
}
