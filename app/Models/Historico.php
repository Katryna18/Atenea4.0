<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    public mixed $Periodo;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'historico';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'peso' => 'float',
        'altura' => 'float',
        'IMC' => 'float',
        'FC' => 'float',
        'PA' => 'float',
    ];
}
