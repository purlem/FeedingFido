<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'city', 'state', 'zip', 'lat', 'lng', 'item',
    ];
}
