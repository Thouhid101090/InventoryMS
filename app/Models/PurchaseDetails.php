<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unitcost',
        'total',
    ];

    protected $guarded = [
        'id',
    ];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }
}
