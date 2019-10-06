<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait UsesUuid
{
    /**
     * Boot function from Laravel
     * use App\Models\Concerns\UsesUuid;
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->incrementing = false;
            $model->primaryKey = 'id';
            $model->keyType = 'uuid';
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
}
