<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'no_telp',
        'jenis_kelamin',
        'tanggal_lahir',
        'lampiran',
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aset(): HasMany
    {
        return $this->hasMany(Aset::class);
    }

    public function sporadik(): HasMany
    {
        return $this->hasMany(Sporadik::class, 'pemilik_lama_id');
    }

    public function sporadikBaru(): HasMany
    {
        return $this->hasMany(Sporadik::class, 'pemilik_baru_id');
    }

}
