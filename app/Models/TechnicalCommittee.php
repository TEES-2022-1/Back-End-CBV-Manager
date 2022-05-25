<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int year
 * @property string coach
 * @property string coach_assistent
 * @property string supervisor
 * @property string personal_trainer
 * @property string physiotherapist
 * @property string masseuse
 * @property string doctor
 */
class TechnicalCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'coach',
        'coach_assistent',
        'supervisor',
        'personal_trainer',
        'physiotherapist',
        'masseuse',
        'doctor',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
