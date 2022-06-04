<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string coach
 * @property string coach_assistant
 * @property string supervisor
 * @property string personal_trainer
 * @property string physiotherapist
 * @property string masseuse
 * @property string doctor
 */
class TechnicalCommittee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'coach',
        'coach_assistant',
        'supervisor',
        'personal_trainer',
        'physiotherapist',
        'masseuse',
        'doctor',
    ];

    public function team(): HasOne
    {
        return $this->hasOne(Team::class);
    }
}
