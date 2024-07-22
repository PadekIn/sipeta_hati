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
        'aset_id',
        'no_surat',
        'tanggal_surat',
        'perihal',
        'keterangan',
        'user_id',
    ];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
