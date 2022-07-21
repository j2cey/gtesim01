<?php

namespace App\Models\Employes;

use App\Models\BaseModel;
use App\Models\Esims\Esim;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PhoneNum
 *
 * @package App\Models\Employes
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 * @property string $numero
 * @property string $hasphonenum_type
 * @property integer $hasphonenum_id
 * @property integer $posi
 * @property integer|null $esim_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $created_by user creator reference
 * @property int|null $updated_by user updator reference
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read Esim|null $esim
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $hasphonenum
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel default($exclude = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereEsimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereHasphonenumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereHasphonenumType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum wherePosi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNum whereUuid($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Status|null $status
 */
class PhoneNum extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Eloquent Relationships

    /**
     * The Model which has this Attribute
     *
     * @return MorphTo
     */
    public function hasphonenum()
    {
        return $this->morphTo();
    }

    public function esim() {
        return $this->belongsTo(Esim::class, 'esim_id');
    }

    #endregion

    public function attachEsim($esim_id) {
        $esim = Esim::getFirstFree($esim_id);

        $esim->setStatutAttribution();

        $this->esim()->associate($esim);
        $this->save();
        $this->esim->saveQrcode();
        $this->save();

        $esim->setStatutAttribue();

        return $this->load(['esim','esim.qrcode']);
    }
}
