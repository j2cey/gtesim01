<?php

namespace App\Models\Comments;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CommentVote
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
 * @property string $vote
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CommentVote extends BaseModel implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $table = "comment_user_vote";

    #region Validation Rules

    public static function defaultRules() {
        return [
            'vote' => ['required'],
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
            'comment.required' => 'Le vote est requis',
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
