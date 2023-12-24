<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnToSupplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_no', 'purchase_date', 'supplier_id', 'purchase_id', 'product_id',
        'returned_quantity', 'total_amount', 'reason', 'created_by', 'updated_by'
    ];
    public function purchaseDetails()
    {
        return $this->hasMany(purchaseDetails::class, 'product_id'); 
    }
    public function purchase(){
        return  $this->belongsTo(Sale::class,'supplier_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function stock(){
        return $this->hasMany(Stock::class);
    }
}
