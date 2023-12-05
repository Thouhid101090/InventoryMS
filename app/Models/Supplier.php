<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }


}
