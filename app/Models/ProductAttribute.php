<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';
    protected $fillable = [
        'product_id',
        'Attribute_type', 
        'Attribute_value'
    ];
    protected static function newFactory()
    {
        return \Database\Factories\ProductAttributeFactory::new();
    }
    public function product(){
        return $this->belongsTo(Product::class, 'id');
    }
}
