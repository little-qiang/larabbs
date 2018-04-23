<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\ReplyTransformer;

class RepliesController extends Controller
{

    public function index(Topic $topic)
    {
        $replies = $topic->replies()->paginate(20);
        return $this->response->paginator($replies, new ReplyTransformer);
    }

    public function userIndex(User $user)
    {
        $replies = $user->replies()->paginate(5);
        return $this->response->paginator($replies, new ReplyTransformer);
    }

    public function store(ReplyRequest $request, Topic $topic, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->topic_id = $topic->id;
        $reply->user_id = $this->user()->id;
        $reply->save();

        return $this->response->item($reply, new ReplyTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Topic $topic, Reply $reply)
    {
        $this->authorize('destroy', $topic, $reply);

        $reply->delete();
        return $this->response->noContent();
    }
}
