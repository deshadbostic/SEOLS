<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PVSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_id',
        'energy_generated',
        'equipment_cost',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class); 
    }

    public function building() : BelongsTo {
        return $this->belongsTo(Building::class); 
    }

    public function pv_system_products() : HasMany {
        return $this->hasMany(PVSystemProduct::class);
    }
}
