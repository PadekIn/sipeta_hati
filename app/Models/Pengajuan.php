<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'jenis_surat',
        'tanggal',
        'perihal',
        'keterangan',
        'lampiran',
        'status',
        'pesan',
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function pbb(): HasOne
    {
        return $this->hasOne(Pbb::class);
    }

    public function sporadik(): HasOne
    {
        return $this->hasOne(Sporadik::class);
    }

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }

}
