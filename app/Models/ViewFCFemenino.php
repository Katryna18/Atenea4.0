<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewFCFemenino extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'view_fc_femenino';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'FC' => 'float',
        'created_at' => 'datetime:Y-m-d H:00',
    ];
}
