<?php

namespace App\Models;

use App\Traits\Base\Uuidable;
use Illuminate\Support\Carbon;
use App\Traits\Base\HasDefault;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Status
 *
 * @package App\Models
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property string $code
 * @property string $name
 * @property string $style
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $created_by user creator reference
 * @property int|null $updated_by user updator reference
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Status active()
 * @method static \Illuminate\Database\Eloquent\Builder|Status default($exclude = [])
 * @method static \Database\Factories\StatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Status inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUuid($value)
 * @mixin \Eloquent
 */
class Status extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, Uuidable, HasDefault;

    protected $guarded = [];

    #region Scopes

    public function scopeDefault($query, $exclude = []) {
        return $query
            ->where('is_default', true)->whereNotIn('id', $exclude);
    }

    public function scopeActive($query) {
        return $query
            ->where('code', 'active');
    }

    public function scopeInactive($query) {
        return $query
            ->where('code', 'inactive');
    }

    #endregion
}
