<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'purchase_id',
        'sales_id',
        'return_from_customer_id',
        'return_to_supplier_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class,'sales_id');
    }
    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id');
    }

}
