<?php

namespace App\Enums;

trait HasLabelTrait
{
    public function label(): string
    {
        return implode(" ",str($this->name)->ucsplit()->toArray());
    }
}
