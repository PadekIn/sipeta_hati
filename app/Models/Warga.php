<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
