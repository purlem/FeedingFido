<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'lat',
        'lng',
        'item',
        'time_window',
        'donor_id',
        'recipient_id',
        'picked_up',
    ];

    // Donor (user who created it - optional)
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    // Recipient (user who accepts it - optional)
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
