<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


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
        $hasNewMessages = Message::where('recipient_id', $userId)
                                 ->where('is_read', false)
                                 ->exists();
    
        $messages = Message::with('article', 'sender', 'recipient')
                            ->where(function($q) use ($userId) {
                                $q->where('sender_id', $userId)
                                  ->orWhere('recipient_id', $userId);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
    
                            $conversations = $messages->groupBy(function($message) use ($userId) {
                                // Erstellen eines einheitlichen Schlüssels für beide Richtungen der Konversation
                                $participants = [$message->sender_id, $message->recipient_id];
                                sort($participants); // Sortieren, um Konsistenz zu gewährleisten
                                return join('-', [
                                    $participants[0],
                                    $participants[1],
                                    $message->article_id
                                ]);
                            })->filter(function($messages) {
                                // Filtern Sie Gruppen heraus, deren neueste Nachricht keine gültige article_id hat
                                return $messages->first()->article_id !== null && $messages->first()->article_id > 0;
                            })->map(function($messages) {
                                $latestMessage = $messages->first(); // Die erste Nachricht nach 'desc' Sortierung ist die neueste
                                $isUnread = $messages->where('is_read', false)
                                                     ->where('recipient_id', auth()->id())
                                                     ->isNotEmpty();
                            
                                return [
                                    'latestMessage' => $latestMessage,
                                    'isUnread' => $isUnread,
                                    'latestMessageDate' => $latestMessage->created_at,
                                    'otherUser' => $latestMessage->sender_id == auth()->id() ? $latestMessage->recipient : $latestMessage->sender,
                                ];
                            });
                            
                            return view('messages.index', compact('conversations', 'hasNewMessages'));
                            
    }
    
    


    
    public function conversation(User $user, $articleId)
    {
        $article = Item::findOrFail($articleId);
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
    
        $groupedMessages = $messages->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });
    
        $hasNewMessages = Message::where('recipient_id', auth()->id())->where('is_read', false)->exists();
    
        return view('messages.conversation', compact('user', 'groupedMessages', 'article', 'articleId', 'hasNewMessages'));
    }
    
    
    

public function reply(Request $request, User $user, $articleId)
{
    $request->validate([
        'body' => 'required|string',
        'image' => 'nullable|image|max:2048', // Validiert, dass es sich um ein Bild handelt und beschränkt die Dateigröße
    ]);

    // Erstelle eine neue Nachricht
    $message = new Message();
    $message->sender_id = auth()->id();
    $message->recipient_id = $user->id;
    $message->article_id = $request->articleId;
    $message->body = $request->body;

    // Verarbeite das hochgeladene Bild, falls vorhanden
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('public/messages/images');
        // Speichere den Pfad zum Bild in der Nachricht oder in einer separaten Tabelle, je nach deiner Struktur
        $message->image_path = $path;
    }

    $message->save();

    return redirect()->route('messages.conversation', ['user' => $user->id, 'articleId' => $articleId])->with('success', 'Nachricht erfolgreich gesendet.');
}


 /**
     * Markiert alle Nachrichten in einer Konversation als gelesen.
     *
     * @param int $conversationId Die ID der Konversation.
     * @return \Illuminate\Http\Response
     */
    public function markConversationAsRead($conversationId)
    {
        $messages = Message::where('article_id', $conversationId)
                            ->where('recipient_id', Auth::id())
                            ->get();

        foreach ($messages as $message) {
            if (!$message->is_read) {
                $message->is_read = true;
                $message->save();
            }
        }

        return redirect()->back()->with('success', 'Konversation als gelesen markiert.');
    }

    /**
     * Markiert eine spezifische Nachricht als gelesen basierend auf ihrer ID.
     *
     * @param int $messageId Die ID der Nachricht.
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($messageId)
    {
        $message = Message::where('id', $messageId)
                           ->where('recipient_id', Auth::id())
                           ->first();

        if ($message) {
            $message->is_read = true;
            $message->save();
        }

        return redirect()->back()->with('success', 'Nachricht als gelesen markiert.');
    }
}

