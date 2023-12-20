<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\SalesDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnFromCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_no', 'sales_date', 'customer_id', 'sale_id', 'product_id',
        'returned_quantity', 'total_amount', 'reason', 'created_by', 'updated_by'
    ];
    public function salesDetails()
    {
        return $this->hasMany(SalesDetails::class, 'product_id'); // Adjust the foreign key as needed
    }
    public function sale(){
        $this->belongsTo(Sale::class,'customer_id','id');
    }
    public function product(){
        $this->belongsTo(Product::class,'product_id','id');
    }
    public function customer(){
        $this->belongsTo(Customer::class,'customer_id','id');
    }
}
