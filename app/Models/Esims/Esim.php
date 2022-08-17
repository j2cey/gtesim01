<?php

namespace App\Models\Esims;

use App\Models\BaseModel;
use App\Models\Employes\PhoneNum;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Esim
 *
 * @package App\Models\Esims
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property string $imsi
 * @property string $iccid
 * @property string $ac
 * @property string $pin
 * @property string $puk
 * @property string $eki
 * @property string $pin2
 * @property string $puk2
 * @property string $adm1
 * @property string $opc
 * @property integer|null $statut_esim_id
 * @property integer|null $technologie_esim_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $status_id status reference
 * @property int|null $created_by user creator reference
 * @property int|null $updated_by user updator reference
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Esims\EsimQrcode|null $qrcode
 * @property-read \App\Models\Esims\StatutEsim|null $statutesim
 * @property-read \App\Models\Esims\TechnologieEsim|null $technologieesim
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel default($exclude = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Esim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Esim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Esim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereAc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereAdm1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereEki($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereIccid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereImsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereOpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim wherePin2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim wherePuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim wherePuk2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereStatutEsimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereTechnologieEsimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Esim whereUuid($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Status|null $status
 */
class Esim extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $with = ['qrcode'];

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

    public function qrcode() {
        return $this->hasOne(EsimQrcode::class, 'esim_id');
    }

    public function phonenum() {
        return $this->hasOne(PhoneNum::class, 'esim_id');
    }

    #endregion

    #region Custom Functions

    public function setStatutAttribue() {
        $esim_attribue_statut = StatutEsim::where('code', "attribue")->first();
        $this->statutesim()->associate($esim_attribue_statut);
        $this->save();
    }

    public function setStatutAttribution() {
        $esim_attribue_statut = StatutEsim::where('code', "attribution")->first();
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

            $esim = Esim::where('statut_esim_id', $esim_nouveau_statut->id)->first();
            $esim->setStatutAttribution();

            return $esim;
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

    public function saveQrcode()
    {
        if ($this->qrcode) {
            // update qrcode
        } else {
            EsimQrcode::createNew($this, $this->ac);
            $this->save();
        }
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
