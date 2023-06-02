<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiAlergi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi_alergi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'alamat',
        'no_hp',
        'gejala',
        'hasil_diagnosa',
        'saran',
    ];
}
