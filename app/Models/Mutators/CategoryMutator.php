<?php

namespace App\Models\Mutators;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CategoryMutator
{
    public function category(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = strtoupper($value);
                return in_array($value, ['MALE', 'FEMALE']) ? $value : null;
            },
        );
    }
}
