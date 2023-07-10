<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergi extends Model
{
    use HasFactory;

    protected $table = 'alergi';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_alergi'
    ];
}
