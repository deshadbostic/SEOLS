<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'solar_panel_id', 
        'solar_panel_count', 
        'battery_id', 
        'battery_count',
        'inverter_id',
        'inverter_count',
        'wire_id',
        'wire_count',
        'energy_generated',
        'equipment_cost',
        'installation_cost'
     ];

     public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function product() : HasMany {
        return $this->hasMany(Product::class);
    }
}
