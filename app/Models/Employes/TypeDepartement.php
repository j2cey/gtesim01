<?php

namespace App\Models\Employes;

use App\Models\BaseModel;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TypeDepartement
 *
 * @package App\Models\Employes
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 * @property string $intitule
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $created_by user creator reference
 * @property int|null $updated_by user updator reference
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employes\Departement[] $departements
 * @property-read int|null $departements_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel default($exclude = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereIntitule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDepartement whereUuid($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Status|null $status
 */
class TypeDepartement extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;
    
    protected $guarded = [];

    #region Eloquent Relationships

    public function departements() {
        return $this->hasMany(Departement::class, 'type_departement_id');
    }

    #endregion

    #region Validation Rules

    public static function defaultRules() {
        return [];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(), [
            'intitule' => ['required','unique:type_departements,intitule,NULL,id,deleted_at,NULL'],
        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [
            'intitule' => ['required','unique:type_departements,intitule,'.$model->id.',id,deleted_at,NULL',],
        ]);
    }
    public static function validationMessages() {
        return [
            'intitule.required' => 'Prière de renseigner l Intitule',
        ];
    }

    #endregion
}
