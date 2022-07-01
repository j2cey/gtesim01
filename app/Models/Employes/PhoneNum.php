<?php

namespace App\Models\Employes;

use App\Models\BaseModel;
use OwenIt\Auditing\Contracts\Auditable;
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
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PhoneNum extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;
    
    protected $guarded = [];
}
