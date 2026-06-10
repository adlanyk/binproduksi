<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location_id',
    ];
public function locations()
{
    return $this->belongsToMany(Location::class);
}

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
                    'is_active' => 'boolean',

        ];
    }
    public function scopeSameLocation($query)
    {
        return $query->where('location_id', auth()->user()->location_id);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function activate()
    {
        $this->update([
            'is_active' => true,
            'activated_at' => now(),
        ]);
    }

    public function deactivate()
    {
        $this->update([
            'is_active' => false,
            'activated_at' => null,
        ]);
    }

    public function isActive(): bool
    {
        return $this->is_active && $this->hasVerifiedEmail();
    }
}
