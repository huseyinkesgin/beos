<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    protected static function bootUuidTrait()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::booted(function ($model) {
            $model->setKeyType('string');
            $model->setIncrementing(false);
            $model->primaryKey = 'uuid';
        });
    }
}
