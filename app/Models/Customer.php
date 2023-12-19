<?php

namespace App\Models;


use App\Models\Sale;
use App\Models\CustomerPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function customerPayment(){
        return $this->hasMany(CustomerPayment::class);
    }
    public function returnCustomer(){
        return $this->hasMany(ReturnFromCustomer::class);
    }
}
