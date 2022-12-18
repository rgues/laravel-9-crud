<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'price', 'description','image_path','user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function provider() {
        return $this->hasOne(ProductProvider::class);
    }

    public function categories() {
        return $this->belongstoMany(Category::class);
    }
}
