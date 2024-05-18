<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function checkForNewMessages()
    {
        $userId = auth()->id();
        $hasNewMessages = Message::where('recipient_id', $userId)
                                 ->where('is_read', false)
                                 ->exists();

        return response()->json(['hasNewMessages' => $hasNewMessages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'article_id' => 'required|exists:items,id',
            'body' => 'required',
        ]);

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->recipient_id = $request->recipient_id;
        $message->article_id = $request->article_id;
        $message->body = $request->body;
        $message->save();

        return response()->json(['message' => 'Nachricht erfolgreich gesendet.', 'data' => $message], 201);
    }

    public function index()
    {
        $userId = auth()->id();
        $messages = Message::with('article', 'sender', 'recipient')
                            ->where('sender_id', $userId)
                            ->orWhere('recipient_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json($messages);
    }

    public function show($id)
    {
        $message = Message::with('article', 'sender', 'recipient')->findOrFail($id);

        return response()->json($message);
    }

    public function conversation(User $user, $articleId)
    {
        $messages = Message::where(function ($query) use ($user, $articleId) {
                                $query->where('sender_id', auth()->id())
                                      ->where('recipient_id', $user->id)
                                      ->where('article_id', $articleId);
                            })
                            ->orWhere(function ($query) use ($user, $articleId) {
                                $query->where('sender_id', $user->id)
                                      ->where('recipient_id', auth()->id())
                                      ->where('article_id', $articleId);
                            })
                            ->get();

        foreach ($messages as $message) {
            if ($message->recipient_id === auth()->id() && !$message->is_read) {
                $message->is_read = true;
                $message->save();
            }
        }

        return response()->json($messages);
    }
}
