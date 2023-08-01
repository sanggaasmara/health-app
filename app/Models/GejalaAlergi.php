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
        'id_alergi',
        'saran'
    ];

    /**
     * Get the alergi associated with the GejalaAlergi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alergi()
    {
        return $this->hasOne(Alergi::class, 'id', 'id_alergi');
    }
}
