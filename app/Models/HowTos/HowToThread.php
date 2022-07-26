<?php

namespace App\Models\HowTos;

use Spatie\Tags\HasTags;
use App\Models\BaseModel;
use App\Traits\Code\HasCode;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HowToThread
 * @package App\Models\HowTos
 *
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string $code
 *
 * @property string $description
 *
 * @property int|null $status_id status reference
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowToThread extends BaseModel implements Auditable
{
    use HasTags, HasCode, HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $with = ['tags','steps'];

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

    public function firststep() {
        return $this->steps()->where('posi', 1);
    }

    public function steps() {
        return $this->hasMany(HowToStep::class);
    }

    public function laststep() {
        return $this->hasOne(HowToStep::class)->ofMany('posi', 'max');
    }

    public function lateststep() {
        return $this->hasOne(HowToStep::class)->latestOfMany();
    }

    #endregion

    #region Custom Functions

    public function nextStep($posi) {
        $next_step_posi = $posi + 1;
        if ( $this->steps()->count() < $next_step_posi ) {
            return null;
        }
        return $this->steps()->where('posi', $next_step_posi)->first();
    }

    public function prevStep($posi) {
        $prev_step_posi = $posi - 1;
        if ( $prev_step_posi === 0 ) {
            return null;
        }
        return $this->steps()->where('posi', $prev_step_posi)->first();
    }

    public static function createNew($title, $description, $code = null, $tags = null) : HowToThread
    {
        $howtothread = self::create([
            'title' => $title,
            'code' => $code,
            'description' => $description,
        ]);

        if ( ! is_null($tags)) {
            $howtothread->syncTags($tags);
        }

        return $howtothread;
    }

    public function updateOne($title, $description, $code = null, $tags = null) : HowToThread
    {
        //dd($tags);
        $current_user = Auth::user();
        $this->update([
            'title' => $title,
            'description' => $description,
        ]);

        if ( ! is_null($code) && ($current_user && $current_user->can('howtothread-update-code')) ) {
            $this->update([
                'code' => $code,
            ]);
        }

        if ( ! is_null($tags)) {
            $this->syncTags($tags);
        }

        return $this;
    }

    public function addNewStep(HowTo $howto, $posi, $step_title = null, $description = null) {
        return HowToStep::createNew($this, $howto, $posi, $step_title, $description);
    }

    #endregion
}
