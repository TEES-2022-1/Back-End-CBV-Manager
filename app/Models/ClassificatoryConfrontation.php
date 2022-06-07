<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificatoryConfrontation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'round',
    ];

    public function confrontation() {
        return $this->morphOne(Confrontation::class, 'confrontable');
    }
}
