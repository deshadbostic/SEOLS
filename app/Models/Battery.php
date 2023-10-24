<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    use HasFactory;

    protected $table = 'battery';

    protected $fillable =['model','capacityAh','voltageV',
    'ratingWh','weightLbs','cost'];

}
