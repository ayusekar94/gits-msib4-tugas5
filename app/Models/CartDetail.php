<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    public function product()
	{
	      return $this->belongsTo(Product::class);
	}

	public function pesanan()
	{
	      return $this->belongsTo(Pesanan::class);
	}
}
