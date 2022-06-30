<?php

namespace App\Models\ImportModels;

use App\Models\BaseModel;
use App\Models\Files\File;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ImportModel
 * @package App\Models\ImportModels
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $title
 * @property string $code
 * @property string $array_values
 * @property string $file_fullname
 * @property string $description
 *
 * @property string $targetmodel_type
 * @property string $filemodel_type
 * 
 * @property string $hasimportmodel_type
 * @property integer $hasimportmodel_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ImportModel extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules()
    {
        return [
            'title' => ['required'],
        ];
    }

    public static function createRules()
    {
        return array_merge(self::defaultRules(), [

        ]);
    }

    public static function updateRules($model)
    {
        return array_merge(self::defaultRules(), [

        ]);
    }

    public static function messagesRules()
    {
        return [

        ];
    }

    #endregion

    #region Eloquent Relationships

    public function file() {
        return $this->belongsTo(File::class, 'file_id');
    }

    #endregion

    #region Custom Functions

    #endregion
}
