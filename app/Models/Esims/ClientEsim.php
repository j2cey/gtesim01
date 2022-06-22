<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClientEsim
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $nom_raison_sociale
 * @property string $prenom 
 * @property string $email
 * @property string $numero_telephone 
 * @property string $pin
 * @property string $puk
 * 
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ClientEsim extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'nom_raison_sociale' => ['required'],
            'email' => ['required','email'],
            'numero_telephone' => ['required'],
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

    public function esim() {
        return $this->belongsTo(Esim::class, 'esim_id');
    }

    #endregion

    #region Custom Functions

    public static function createNew($esim_id, $nom_raison_sociale, $prenom, $email, $numero_telephone)
    {
        $esim = Esim::getFirstFree($esim_id);

        $clientesim = ClientEsim::create([
            'nom_raison_sociale' => $nom_raison_sociale,
            'prenom' => $prenom,
            'email' => $email,
            'numero_telephone' => $numero_telephone,
        ]);

        $clientesim->esim()->associate($esim);

        $clientesim->save();

        $esim->setStatutAttribue();

        return $clientesim;
    }

    public function updateOne($esim_id, $nom_raison_sociale, $prenom, $email, $numero_telephone)
    {
        $esim = Esim::getFirstFree($esim_id);

        $esim->setStatutFree();

        $this->update([
            'nom_raison_sociale' => $nom_raison_sociale,
            'prenom' => $prenom,
            'email' => $email,
            'numero_telephone' => $numero_telephone,
        ]);

        $this->esim()->associate($esim);

        $this->save();

        $esim->setStatutAttribue();

        return $this;
    }

    #endregion
}
