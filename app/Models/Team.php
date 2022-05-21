<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string name
 * @property int year_foundation
 * @property string gymnasium
 * @property string category
 * @property Carbon validated
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_foundation',
        'gymnasium',
        'category',
        'validated'
    ];

    public function technicalCommittees(): HasMany
    {
        return $this->hasMany(TechnicalCommittee::class);
    }
}
