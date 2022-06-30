<?php

namespace App\Models\Files;

use App\Models\BaseModel;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FileImportResult
 * @package App\Models\Files
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property boolean $imported
 *
 * @property Carbon $importstart_at
 * @property Carbon $importend_at
 *
 * @property integer $nb_rows
 * @property boolean $import_processing
 * @property integer $nb_rows_success
 * @property integer $nb_rows_failed
 * @property integer $nb_rows_processing
 * @property integer $nb_rows_processed
 * @property integer|null $file_id
 *
 * @property string $row_last_processed
 * @property integer $nb_try
 * @property Json $report
 *
 * @property Carbon $suspended_at
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FileImportResult extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;
    
    protected $guarded = [];

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

    #endregion
}
