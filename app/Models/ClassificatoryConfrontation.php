<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ClassificatoryConfrontation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'round',
    ];

    public function confrontation(): MorphOne
    {
        return $this->morphOne(Confrontation::class, 'confrontable');
    }
}
