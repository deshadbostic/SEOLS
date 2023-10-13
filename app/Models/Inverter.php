<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inverter extends Model
{
    use HasFactory;

    protected $table = 'inverter';

    protected $fillable =['Model','InputPowerWatts','OutputPowerWatts',
    'SizeInches','FrequencyHz','Effieciency','Cost'];
}
