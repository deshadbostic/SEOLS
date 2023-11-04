<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';

    protected $fillable = [
        'Attribute_type', 'Attribute_value'
    ];

    public function product(){
        
        return $this->belongsTo(Product::class);
    }
}
