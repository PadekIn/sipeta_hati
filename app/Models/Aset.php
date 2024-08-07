<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'jenis_barang',
        'luas',
        'alamat',
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function warga():BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }

    public function pbb():HasMany
    {
        return $this->hasMany(Pbb::class);
    }

    public function sporadik():HasMany
    {
        return $this->hasMany(Sporadik::class);
    }

}
