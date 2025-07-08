<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Chat;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();

        $chat = Chat::find($data['chat_id']);

        if (!$chat->users()->get()->contains('id', $request->user()->id)) {
            return abort(403, "You are not allowed to send a message in this chat!");
        }

        $message = Message::create([
            'chat_id' => $data['chat_id'],
            'author_id' => $request->user()->id,
            'content' => $data['message']
        ]);

        if ($request->header('Hx-Request')) {
            return view('chats.partials.message', compact('message'));
        } else {
            return redirect()->route('chats.show', $chat->id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }
}
