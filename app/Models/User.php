<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_DONOR = 'donor';
    const ROLE_RECIPIENT = 'recipient';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function listings()
    {
        return match ($this->role) {
            self::ROLE_DONOR => $this->donatedListings(),
            self::ROLE_RECIPIENT => $this->acceptedListings(),
            default => collect(), // Admins or undefined roles get an empty collection
        };
    }

    public function donatedListings()
    {
        return $this->hasMany(Listing::class, 'donor_id');
    }

    public function acceptedListings()
    {
        return $this->hasMany(Listing::class, 'recipient_id');
    }

    public function shortName(): string
    {
        $parts = explode(' ', $this->name);
        return $parts[0] . ' ' . (isset($parts[1]) ? substr($parts[1], 0, 1) . '.' : '');
    }
}
