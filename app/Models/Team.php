<?php

namespace App\Models;

use App\Events\TeamCreated;
use App\Models\Mutators\CategoryMutator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property string name
 * @property int year_foundation
 * @property string gymnasium
 * @property string category
 * @property Carbon affiliated_federation_in
 * @property string image
 */
class Team extends Model
{
    use HasFactory, CategoryMutator;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'year_foundation',
        'gymnasium',
        'category',
        'affiliated_federation_in'
    ];

    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function technicalCommittee(): HasOne
    {
        return $this->hasOne(TechnicalCommittee::class);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }
}
