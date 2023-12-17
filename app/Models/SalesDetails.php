<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesDetails extends Model
{
    use HasFactory;
    public function sale()
    {
        return $this->belongsTo(Sale::class,'sales_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
   
}
