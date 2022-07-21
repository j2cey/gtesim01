<?php

namespace App\Models\Howtos;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HowtoStepType
 *
 * @package App\Models\HowTo
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property string $title
 * @property string $description
 * @property integer|null $created_by
 * @property integer|null $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel default($exclude = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType query()
 * @mixin \Eloquent
 * @property-read \App\Models\Status $status
 * @property int|null $status_id status reference
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStepType whereUuid($value)
 */
class HowtoStepType extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'title' => ['required'],
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
            'title.required' => 'The Title is required',
        ];
    }

    #endregion

    #region Eloquent Relationships



    #endregion

    #region Custom Functions

    public static function createNew($title, $description) : HowtoStepType
    {
        return HowtoStepType::create([
            'title' => $title,
            'description' => $description,
        ]);
    }

    #endregion
}
