<?php

namespace App\Models\HowTo;

use App\Models\BaseModel;
use App\Traits\Tag\HasTags;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HowtoStep
 * @package App\Models
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string|null $view
 * @property string $description
 *
 * @property integer|null $howto_step_prev_id
 * @property integer|null $howto_step_next_id
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowtoStep extends BaseModel implements Auditable
{
    use HasTags, HasFactory, \OwenIt\Auditing\Auditable;

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

    #endregn

    #region Eloquent Relationships

    public function howtosteptype() {
        return $this->belongsTo(HowtoStepType::class, 'howto_step_type_id');
    }

    #endregion

    #region Custom Functions

    public static function createNew(HowtoStepType $howtosteptype, $title, $view, $description) : HowtoStep
    {
        $howtostep = HowtoStep::create([
            'title' => $title,
            'view' => $view,
            'description' => $description,
        ]);

        $howtostep->howtosteptype()->associate($howtosteptype);

        return $howtostep;
    }

    #endregion
}
