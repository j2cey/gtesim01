<?php

namespace App\Models\Comments;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CommentSpam
 * @package App\Models\Comments
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property integer $comment_id
 * @property integer $user_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CommentSpam extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $table = "comment_spam";

    #region Validation Rules

    public static function defaultRules() {
        return [
        ];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(),
            []
        );
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(),
            []
        );
    }

    public static function messagesRules() {
        return [
        ];
    }

    #endregion

    #region Eloquent Relationships

    #endregion

    #region Custom Functions

    public static function createNew()
    {
    }

    public function updateOne()
    {
    }

    #endregion
}
