<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomtingKelas extends Model
{
    use HasFactory;

    protected $table = 'komting_kelas';

    protected $fillable = [
        'user_id',
        'kelas',
        'no_hp',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
