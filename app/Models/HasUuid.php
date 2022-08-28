<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
