<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PVSystemProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'pv_system_id',
        'product_id',
        'product_count'
    ];


    public function pv_system() : BelongsTo {
        return $this->belongsTo(PVSystem::class); 
    }
}
