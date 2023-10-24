<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarPanel extends Model
{
    use HasFactory;

    protected $table = 'solar_panel';

    protected $fillable = [
        'Model', 'Warranty', 'Durability',
        'Cost', 'EnergyOutputWatts', 'DimensionsInches'
    ];
}
