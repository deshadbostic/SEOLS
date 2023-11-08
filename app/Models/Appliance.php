<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appliance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_id',
        'wattage',
       
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
