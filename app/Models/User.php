<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function role(){
        return $this->belongsTo(Role::class,'role_id');

    }
};
