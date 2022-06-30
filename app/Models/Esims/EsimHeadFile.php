<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use App\Traits\File\HasFile;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EsimHeadFile
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string $config_key 
 * @property string $comment 
 * 
 * @property integer|null $statut_esim_id 
 * @property integer|null $technologie_esim_id 
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class EsimHeadFile extends BaseModel implements Auditable
{
    use HasFile, HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'imsi' => ['required'],
        ];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(), [

        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [

        ]);
    }

    public static function messagesRules() {
        return [

        ];
    }

    #endregion

    #region Eloquent Relationships

    #endregion

    #region Custom Functions

    #endregion
}
