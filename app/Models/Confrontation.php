<?php

namespace App\Models;

use App\Events\ConfrontationUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string scheduling
 * @property string result_host
 * @property string result_guest
 * @property string set1_points_host
 * @property string set1_points_guest
 * @property string set2_points_host
 * @property string set2_points_guest
 * @property string set3_points_host
 * @property string set3_points_guest
 * @property string set4_points_host
 * @property string set4_points_guest
 * @property string set5_points_host
 * @property string set5_points_guest
 */
class Confrontation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = [
        'id',
        'confrontable_id',
        'confrontable_type',
    ];

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


    protected $dispatchesEvents = [
        'updated' => ConfrontationUpdated::class,
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function teamHost(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function teamGuest(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function confrontable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'confrontable_type', 'confrontable_id');
    }
}
