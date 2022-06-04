<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string name
 * @property string birthday
 * @property string document
 * @property string shirt_number
 */

class Player extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'birthday',
        'document',
        'shirt_number',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
