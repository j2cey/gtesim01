<?php

namespace App\Models\Employes;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EmailAddress
 * @package App\Models\Employes
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $email
 * @property string $hasemailaddress_type
 * @property integer $hasemailaddress_id
 * @property integer $posi
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class EmailAddress extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Eloquent Relationships

    /**
     * The Model which has this Attribute
     *
     * @return MorphTo
     */
    public function hasemailaddress()
    {
        return $this->morphTo();
    }

    #endregion
}
