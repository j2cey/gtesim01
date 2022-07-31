<?php

namespace App\Http\Controllers\Comments;

use Auth;
use App\Models\User;
use App\Models\Comments\Comment;
use App\Http\Controllers\Controller;
use App\Models\Comments\CommentVote;
use App\Models\Comments\CommentSpam;
use Illuminate\Database\Eloquent\Model;
use Tightenco\Collect\Support\Collection;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $pageId
     * @return \Illuminate\Support\Collection|Collection|void
     */
    public function index($pageId)
    {
        //
        $comments = Comment::where('page_id',$pageId)->get();

        $commentsData = [];

        foreach ($comments as $key) {
            $user = User::find($key->users_id);
            $name = $user->name;
            $replies = $this->replies($key->id);
            $photo = $user->first()->photo_url;
            // dd($photo->photo_url);
            $reply = 0;
            $vote = 0;
            $voteStatus = 0;
            $spam = 0;
            if(Auth::user()){
                $voteByUser = CommentVote::where('comment_id',$key->id)->where('user_id',Auth::user()->id)->first();
                $spamComment = CommentSpam::where('comment_id',$key->id)->where('user_id',Auth::user()->id)->first();

                if($voteByUser){
                    $vote = 1;
                    $voteStatus = $voteByUser->vote;
                }

                if($spamComment){
                    $spam = 1;
                }
            }

            if(sizeof($replies) > 0){
                $reply = 1;
            }

            if(!$spam){
                $commentsData[] = [
                    "name" => $name,
                    "photo_url" => (string)$photo,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "votes" => $key->votes,
                    "reply" => $reply,
                    "votedByUser" => $vote,
                    "vote" => $voteStatus,
                    "spam" => $spam,
                    "replies" => $replies,
                    "date" => $key->created_at->toDateTimeString()
                ];
            }

        }
        return collect($commentsData)->sortBy('votes');
    }

    protected function replies($commentId)
    {
        $comments = Comment::where('reply_id',$commentId)->get();
        $replies = [];


        foreach ($comments as $key) {
            $user = User::find($key->users_id);
            $name = $user->name;
            $photo = $user->first()->photo_url;

            $vote = 0;
            $voteStatus = 0;
            $spam = 0;

            if( Auth::user() ){
                $voteByUser = CommentVote::where('comment_id',$key->id)->where('user_id',Auth::user()->id)->first();
                $spamComment = CommentSpam::where('comment_id',$key->id)->where('user_id',Auth::user()->id)->first();

                if($voteByUser){
                    $vote = 1;
                    $voteStatus = $voteByUser->vote;
                }

                if($spamComment){
                    $spam = 1;
                }
            }
            if(!$spam){

                $replies[] = [
                    "name" => $name,
                    "photo_url" => $photo,
                    "commentid" => $key->id,
                    "comment" => $key->comment,
                    "votes" => $key->votes,
                    "votedByUser" => $vote,
                    "vote" => $voteStatus,
                    "spam" => $spam,
                    "date" => $key->created_at->toDateTimeString()
                ];
            }


        }

        return collect($replies)->sortBy('votes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return Comment|Model|void
     */
    public function store(StoreCommentRequest $request)
    {
        return Comment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return void
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return void
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return Model|void
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if ( $request->update_type === "vote" ){
            $this->validate($request, [
                'vote' => 'required',
                'users_id' => 'required',
            ]);
            //$comments = Comment::find($commentId);
            $data = [
                "comment_id" => $comment->id,
                'vote' => $request->vote,
                'user_id' => $request->users_id,
            ];
            if($request->vote === "up"){
                //$comment = $comments->first();
                $vote = $comment->votes;
                $vote++;
                $comment->votes = $vote;
                $comment->save();
            }
            if($request->vote === "down"){
                //$comment = $comments->first();
                $vote = $comment->votes;
                $vote--;
                $comment->votes = $vote;
                $comment->save();
            }
            return CommentVote::create($data);
        }
        if ( $request->update_type === "spam" ) {

            $this->validate($request, [
                'users_id' => 'required',
            ]);

            //$comments = Comment::find($commentId);
            //$comment = $comments->first();
            $spam = $comment->spam;
            $spam++;
            $comment->spam = $spam;
            $comment->save();

            $data = [
                "comment_id" => $comment->id,
                'user_id' => $request->users_id,
            ];
            return CommentSpam::create($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return void
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
