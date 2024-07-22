<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
