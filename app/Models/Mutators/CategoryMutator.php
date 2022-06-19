<?php

namespace App\Models\Mutators;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CategoryMutator
{
    protected function category(): Attribute
    {
        return Attribute::set(
            function ($value) {
                $value = strtoupper($value);
                return in_array($value, ['MALE', 'FEMALE']) ? $value : null;
            },
        );
    }
}
