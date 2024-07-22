<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'status' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function warga():HasOne
    {
        return $this->hasOne(Warga::class);
    }

    public function pbb():HasMany
    {
        return $this->hasMany(Pbb::class);
    }
}
