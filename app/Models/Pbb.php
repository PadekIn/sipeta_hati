<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pbb extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'jenis_barang',
        'luas',
        'alamat',
        'no_surat',
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

}
