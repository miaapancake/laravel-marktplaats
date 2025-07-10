<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\MessageReceived;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public static function middleware()
    {
        return [
            'auth'
        ];
    }
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

        broadcast(new ChatMessageSent($message))->toOthers();

        foreach ($chat->users()->get() as $user) {
            Mail::to($user)->send(new MessageReceived($message));
        }

        if ($request->header('Hx-Request')) {
            return view('chats.partials.message', compact('message'));
        } else {
            return redirect()->route('chats.show', $chat->id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Message $message)
    {
        if (!$message->chat->users()->get()->contains('id', $request->user()->id)) {
            return abort(403, "You are not allowed to view messages in this chat!");
        }

        if ($request->header('Hx-Request')) {
            return view('chats.partials.message', compact('message'));
        } else {
            return redirect()->route('chats.show', $message->chat->id);
        }
    }
}
