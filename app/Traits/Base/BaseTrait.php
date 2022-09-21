<?php

namespace App\Traits\Base;


use Illuminate\Support\Facades\Auth;

trait BaseTrait
{
    use Uuidable, StatusTrait, HasDefault, HasCreator;

    public static function bootBaseTrait()
    {
        static::saving(function ($model) {
            if (is_null($model->status_id)) {
                $model->setDefaultStatus();
            }
        });
    }
}
