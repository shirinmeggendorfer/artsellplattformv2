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
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Maximum 2MB
        ]);
    
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->recipient_id = $request->recipient_id;
        $message->is_read = false;
        $message->article_id = $request->article_id;
        $message->body = $request->body;
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $message->image = $path;
        }
    
        $message->save();
    
        return response()->json(['message' => 'Nachricht erfolgreich gesendet.', 'data' => $message], 201);
    }
    

    public function index()
    {
        $userId = auth()->id();
        $messages = Message::with(['article', 'sender', 'recipient'])
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

    public function conversation($userId, $articleId)
    {
        $currentUserId = auth()->id();
    
        $messages = Message::with(['sender', 'recipient', 'article'])  // Laden der Beziehungen
            ->where(function ($query) use ($currentUserId, $userId, $articleId) {
                $query->where('sender_id', $currentUserId)
                      ->where('recipient_id', $userId)
                      ->where('article_id', $articleId);
            })->orWhere(function ($query) use ($currentUserId, $userId, $articleId) {
                $query->where('sender_id', $userId)
                      ->where('recipient_id', $currentUserId)
                      ->where('article_id', $articleId);
            })->orderBy('created_at', 'asc')->get();
    
        // Mark all messages as read
        foreach ($messages as $message) {
            if ($message->recipient_id == $currentUserId && !$message->is_read) {
                $message->is_read = true;
                $message->save();
            }
        }
    
        return response()->json($messages);
    }
    
    
    
    
    
}