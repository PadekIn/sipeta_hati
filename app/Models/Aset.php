<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aset extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'jenis_barang',
        'luas',
        'alamat',
    ];

    public function warga():BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }

    public function pbb():HasMany
    {
        return $this->hasMany(Pbb::class);
    }

}
