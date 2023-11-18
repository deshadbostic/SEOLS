<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PVSystemTemplateProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_number',
        'product_id',
        'product_count',
    ];
}
