<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Esim
 * @package App\Models\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $imsi
 * @property string $iccid 
 * @property string $ac 
 * @property string $pin
 * @property string $puk
 * 
 * @property string $eki
 * @property string $pin2
 * @property string $puk2
 * @property string $adm1
 * @property string $opc
 * 
 * @property integer|null $statut_esim_id 
 * @property integer|null $technologie_esim_id 
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Esim extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

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

    public function statutesim() {
        return $this->belongsTo(StatutEsim::class, 'statut_esim_id');
    }

    public function technologieesim() {
        return $this->belongsTo(TechnologieEsim::class, 'technologie_esim_id');
    }

    #endregion

    #region Custom Functions

    public function setStatutAttribue() {
        $esim_attribue_statut = StatutEsim::where('code', "attribue")->first();
        $this->statutesim()->associate($esim_attribue_statut);
        $this->save();
    }

    public function setStatutFree() {
        $esim_nouveau_statut = StatutEsim::where('code', "nouveau")->first();
        $this->statutesim()->associate($esim_nouveau_statut);
        $this->save();
    }

    public static function getFirstFree($esim_id = -1) {
        if ($esim_id === -1 || is_null($esim_id)) {
            $esim_nouveau_statut = StatutEsim::where('code', "nouveau")->first();
            return Esim::where('statut_esim_id', $esim_nouveau_statut->id)->first();
        } else {
            return Esim::where('id', $esim_id)->first();
        }
    }

    public static function createNew($imsi, $iccid, $ac, $pin, $puk, $eki = null, $pin2 = null, $puk2 = null, $adm1 = null, $opc = null)
    {
        $default_statutesim = StatutEsim::getDefault();
        $default_technologieesim = TechnologieEsim::getDefault();

        $esim = Esim::create([
            'imsi' => $imsi,
            'iccid' => $iccid,
            'ac' => $ac,
            'pin' => $pin,
            'puk' => $puk,
            'eki' => $eki,
            'pin2' => $pin2,
            'puk2' => $puk2,
            'adm1' => $adm1,
            'opc' => $opc,
        ]);

        $esim->statutesim()->associate($default_statutesim); 
        $esim->technologieesim()->associate($default_technologieesim); 
        
        $esim->save();

        return $esim;
    }

    #endregion

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::creating(function($model){
            
        });
    }
}
