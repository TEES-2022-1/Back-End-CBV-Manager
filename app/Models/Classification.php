<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int confrontations_win
 * @property int confrontations_loss
 * @property int sets_win
 * @property int sets_loss
 * @property int points_win
 * @property int points_loss
 * @property int results_3_0
 * @property int results_3_1
 * @property int results_3_2
 * @property int results_0_3
 * @property int results_1_3
 * @property int results_2_3
 */
class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'confrontations_win',
        'confrontations_loss',
        'sets_win',
        'sets_loss',
        'points_win',
        'points_loss',
        'results_3_0',
        'results_3_1',
        'results_3_2',
        'results_0_3',
        'results_1_3',
        'results_2_3',
    ];

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
