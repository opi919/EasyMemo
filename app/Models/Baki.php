<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baki extends Model
{
    use HasFactory;
    protected $table='bakis';
    protected $guarded = [];
}
