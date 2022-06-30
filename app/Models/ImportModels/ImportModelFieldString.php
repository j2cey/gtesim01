<?php

namespace App\Models\ImportModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ImportModels\IsInnerImportModelFieldType;
use App\Contracts\ImportModels\IInnerImportModelFieldType;

/**
 * Class ImportModelFieldString
 * @package App\Models\ImportModels
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $importvalue
 * @property string $comment
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ImportModelFieldString extends BaseModel implements IInnerImportModelFieldType
{
    use HasFactory, IsInnerImportModelFieldType;

    protected $guarded = [];
    protected $with = ['status'];

    #region Validation Rules

    public static function defaultRules() {
        return [
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

    public static function createNew(): ImportModelFieldString {

        $importmodelfieldstring = ImportModelFieldString::create();

        return $importmodelfieldstring;
    }

    public function getFormattedValue($importvalue) {
        $field = $this->getImportmodelfield();

        $this->importvalue = $importvalue;
        return $importvalue;
    }

    #endregion
}
