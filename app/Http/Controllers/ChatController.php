<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ChatController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $chats = $request->user()->chats;
        return view('chats.index', compact('chats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        $data = $request->validated();

        $post = Post::find($data['post_id']);

        if (!$post->exists) {
            return abort(404, "Ad not found!");
        }

        $post_author = $post->user;

        $chat = Chat::create($data);

        $chat->users()->sync([
            $request->user()->id,
            $post_author->id
        ]);

        return redirect()->route('chats.show', $chat->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Chat $chat)
    {
        if (!$request->user()->can('view', $chat)) {
            return abort(403, "You are not allowed to view this chat!");
        }
        return view('chats.show', compact('chat'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
