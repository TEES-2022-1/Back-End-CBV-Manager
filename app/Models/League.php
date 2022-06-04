<?php

namespace App\Models;

use App\Models\Mutators\CategoryMutator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property string title
 * @property int year
 * @property string category
 * @property Carbon begin_in
 * @property Carbon classificatory_limit
 * @property Carbon quarter_finals_limit
 * @property Carbon semifinals_limit
 * @property Carbon finish_in
 */
class League extends Model
{
    use HasFactory, CategoryMutator;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'year',
        'category',
        'begin_in',
        'classificatory_limit',
        'quarter_finals_limit',
        'semifinals_limit',
        'finish_in'
    ];
}
