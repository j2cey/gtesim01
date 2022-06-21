<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TechnologieEsim
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $libelle
 * @property string $code 
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TechnologieEsim extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'libelle' => ['required'],
            'code' => ['required'],
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

    public static function createNew($libelle, $code, $description)
    {
        $technologieesim = TechnologieEsim::create([
            'libelle' => $libelle,
            'code' => $code,
            'description' => $description,
        ]);

        return $technologieesim;
    }

    #endregion
}
