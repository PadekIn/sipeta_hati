<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sporadik extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'pemilik_lama_id',
        'pemilik_baru_id',
        'jenis_barang',
        'luas',
        'alamat',
        'no_surat',
        'jenis_surat',
        'tanggal_surat',
        'lampiran',
    ];


    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class);
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
