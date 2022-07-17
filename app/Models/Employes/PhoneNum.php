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
 * @package App\Models\Employes
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $numero
 * @property string $hasphonenum_type
 * @property integer $hasphonenum_id
 * @property integer $posi
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
