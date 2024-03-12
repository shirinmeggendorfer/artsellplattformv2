<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class MessageController extends Controller
{
    public function create(User $recipient,$articleId)
    {
        return view('messages.create', compact('recipient', 'articleId'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'recipient_id' => 'required|exists:users,id',
                'article_id' => 'required|exists:items,id',
                'message' => 'required',
            ]);
    
            $message = new Message();
            $message->sender_id = auth()->id();
            $message->recipient_id = $request->recipient_id;
            $message->article_id = $request->article_id;
            $message->body = $request->message;
            $message->save();
    
            return redirect()->route('messages.index')->with('success', 'Nachricht erfolgreich gesendet.');
        } catch (\Exception $e) {
            \Log::error('Fehler beim Speichern der Nachricht: ' . $e->getMessage());
            return back()->withErrors('Fehler beim Speichern der Nachricht. Bitte versuche es erneut.');
        }
    }
    
    
    public function index()
    {
        $userId = auth()->id();
    
       
        $conversations = Message::where('recipient_id', $userId)
            ->orWhere('sender_id', $userId)
            ->with('article', 'sender', 'recipient')
            ->get()
            ->groupBy(function ($message) {
                if ($message->sender_id == auth()->id()) {
                    return $message->recipient_id . '-' . $message->article_id;
                } else {
                    return $message->sender_id . '-' . $message->article_id;
                }
            });
    
        $flattenedConversations = $conversations->flatten(1)->unique('id');
    
        return view('messages.index', compact('flattenedConversations'));
    }
    

    public function conversation(User $user, $articleId)
    {
        $article = Item::findOrFail($articleId);  
    $messages = Message::where(function($query) use ($user, $articleId) {
                        $query->where('sender_id', auth()->id())
                              ->where('recipient_id', $user->id)
                              ->where('article_id', $articleId);
                    })
                    ->orWhere(function($query) use ($user, $articleId) {
                        $query->where('sender_id', $user->id)
                              ->where('recipient_id', auth()->id())
                              ->where('article_id', $articleId);
                    })
                    ->orderBy('created_at')
                    ->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->created_at)->format('Y-m-d');
                    });

                    return view('messages.conversation', compact('user', 'messages', 'article'));
                }

    public function reply(Request $request, User $user)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $user->id,
            'body' => $request->body,
        ]);

        return redirect()->route('messages.conversation', $user->id)->with('success', 'Nachricht erfolgreich gesendet.');
    }
}
