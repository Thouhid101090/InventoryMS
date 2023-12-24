<?php

namespace App\Models;


use App\Models\ReturnToSupplier;
use App\Models\ReturnFromCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function rtcustomer(){
        return $this->belongsTo(ReturnFromCustomer::class,'return_from_customer_id');
    }
    public function rtsupplier(){
        return $this->belongsTo(ReturnToSupplier::class,'return_to_supplier_id');
    }

}
