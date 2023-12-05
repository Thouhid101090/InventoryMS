<?php

namespace App\Models;


use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    public function sale(){
        return $this->hasMany(Sale::class);
    }
}
