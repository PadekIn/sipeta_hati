<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Saparodik extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemilik_lama_id',
        'pemilik_baru_id',
        'aset_id',
        'no_surat',
        'jenis_surat',
        'tanggal_surat',
    ];

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }

    public function pemilik_lama(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'pemilik_lama_id');
    }

    public function pemilik_baru(): BelongsTo
    {
        return $this->belongsTo(Warga::class, 'pemilik_baru_id');
    }
}
