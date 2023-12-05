<?php

namespace App\Models;
// use app\Models\Category;
use App\Models\Sale;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory ;

    protected $fillable = [
        'product_name',
        'category_id',
        'product_code',
        'brand',
        'product_image',
        'selling_price',
    ];

    // public $sortable = [
    //     'product_name',
    //     'category_id',
    //     'product_code',
    //     'brand',
    //     'selling_price',
    // ];

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'category',
    ];

    public function category() {
            return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }


    public function details(){
        return $this->hasMany(SalesDetails::class,'product_id','id');
    }
    public function sale(){
        return $this->hasMany(Sale::class,'sale_id','id');
    }
    public function pdetails(){
        return $this->hasMany(PurchaseDetails::class,'product_id','id');
    }
    public function purchase(){
        return $this->hasMany(Purchase::class,'purchase_id','id');
    }


    public function scopeFilter($query,array $fillable)
    {
        $query->when($fillable['search'] ?? false, function($query,$search){
            return $query->where('product_name','like', '%' . $search . '%');
        });
    }
}
