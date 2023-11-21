<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\RoomHelper;

class Room extends Model
{
    use RoomHelper;
    use HasFactory;

    protected $fillable = [
        'name',
        'building_id',
       
    ];

    public function appliance(): HasMany
    {
        return $this->hasMany(Appliance::class);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

}
