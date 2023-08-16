<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewPAMasculino extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'view_pa_masculino';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

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
