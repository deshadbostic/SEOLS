<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseInfo extends Model
{
    use HasFactory;

    protected $table = 'house_info';
    
    protected $fillable = ['customer_fName', 'customer_lName' , 'electricity_usage',
            'roof_size', 'roof_slope', 'roof_age'];

    public $timestamps = false;
}
