<?php

namespace App\Traits\Base;


use Illuminate\Support\Facades\Auth;

trait BaseTrait
{
    use Uuidable, StatusTrait, HasDefault;

    public static function bootBaseTrait()
    {
        static::saving(function ($model) {
            if (is_null($model->status_id)) {
                $model->setDefaultStatus();
            }
        });

        static::creating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });
    }
}
