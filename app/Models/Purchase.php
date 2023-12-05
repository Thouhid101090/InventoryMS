<?php

namespace App\Models;

use App\Models\Product;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'supplier_id',
    //     'purchase_date',
    //     'purchase_no',
    //     'purchase_status',
    //     'total_amount',
    //     'created_by',
    //     'updated_by',
    // ];

    // public $sortable = [
    //     'purchase_date',
    //     'total_amount',
    // ];
    // protected $guarded = [
    //     'id',
    // ];

    // protected $with = [
    //     'supplier',
    //     'user_created',
    //     'user_updated',
    // ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }


    public function details(){
        return $this->hasMany(PurchaseDetails::class);
    }
    


}
