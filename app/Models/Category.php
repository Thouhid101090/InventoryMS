<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // protected $sortable = [
    //     'name',
    //     'slug',
    // ];

    protected $guareded = [
        'id',
    ];

    public function scopeFilter($query, array $fillable)
    {
        $query->when($fillable['search'] ?? false, function($query,$search){
            return $query->where('name','like','%' . $search . '%');
        });
    }
        public function getRouteKeyName()
        {
            return 'slug';
        }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
