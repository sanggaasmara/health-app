<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GejalaAlergi extends Model
{
    use HasFactory;

    protected $table = 'gejala_alergi';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_gejala',
        'id_alergi'
    ];
}
