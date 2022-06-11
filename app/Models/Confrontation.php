<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Confrontation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'scheduling',
        'result_host',
        'result_guest',
        'set1_points_host',
        'set1_points_guest',
        'set2_points_host',
        'set2_points_guest',
        'set3_points_host',
        'set3_points_guest',
        'set4_points_host',
        'set4_points_guest',
        'set5_points_host',
        'set5_points_guest',
    ];

    public function confrontable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'confrontable_type', 'confrontable_id');
    }
}
