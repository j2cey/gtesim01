<?php

namespace App\Models\Howtos;

use Spatie\Tags\HasTags;
use App\Models\BaseModel;
use App\Traits\Code\HasCode;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Howtos
 *
 * @package App\Models
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property string $title
 * @property string $code
 * @property string|null $view
 * @property string $description
 * @property integer|null $howto_step_prev_id
 * @property integer|null $howto_step_next_id
 * @property int $posi step posi
 * @property int|null $howto_step_type_id howto_step_type reference
 * @property int|null $status_id status reference
 * @property integer|null $created_by
 * @property integer|null $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \App\Models\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Howtos\HowtoStepType|null $howtosteptype
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel default($exclude = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep query()
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep withAnyTagsOfAnyType($tags)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereHowtoStepNextId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereHowtoStepPrevId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereHowtoStepTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep wherePosi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HowtoStep whereView($value)
 */
class HowtoStep extends BaseModel implements Auditable
{
    use HasTags, HasCode, HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    #region Validation Rules

    public static function defaultRules() {
        return [
            'title' => ['required'],
            'code' => ['required'],
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

    #endregn

    #region Eloquent Relationships

    public function howtosteptype() {
        return $this->belongsTo(HowtoStepType::class, 'howto_step_type_id');
    }

    #endregion

    #region Custom Functions

    /**
     * @param HowtoStepType $howtosteptype
     * @param $title
     * @param $view
     * @param null $description
     * @param null $code
     * @return HowtoStep
     */
    public static function createNew(HowtoStepType $howtosteptype, $title, $view, $description = null, $code = null) : HowtoStep
    {
        $howtostep = HowtoStep::create([
            'title' => $title,
            'code' => $code,
            'view' => $view,
            'description' => $description,
        ]);

        $howtostep->howtosteptype()->associate($howtosteptype);

        return $howtostep;
    }

    #endregion
}
