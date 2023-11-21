<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'schedule'; // Specify the correct table name
    protected $fillable = ['id', 'user_id', 'fName', 'lName', 'address', 'DOA', 'time', 'directions'];
}
