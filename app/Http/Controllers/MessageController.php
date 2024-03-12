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

    // Initialisiere ein leeres Array für die gruppierten Konversationen
    $groupedConversations = [];

    // Hole alle Nachrichten des Benutzers
    $messages = Message::with('article', 'sender', 'recipient')
                    ->where('sender_id', $userId)
                    ->orWhere('recipient_id', $userId)
                    ->get();

    // Gruppiere die Nachrichten nach Artikel und dem anderen Benutzer
    foreach ($messages as $message) {
        $otherUserId = $message->sender_id == $userId ? $message->recipient_id : $message->sender_id;
        $key = $otherUserId . '-' . $message->article_id;
        
        // Prüfe, ob diese Konversation bereits existiert
        if (!isset($groupedConversations[$key])) {
            $groupedConversations[$key] = $message;
        }
    }

    // Konvertiere die gruppierten Konversationen in eine Collection für die Ansicht
    $conversations = collect(array_values($groupedConversations));

    return view('messages.index', compact('conversations'));
}

    

    public function conversation(User $user, $articleId)
{
    // Holen des Artikels und der Nachrichten
    $article = Item::findOrFail($articleId); // Stelle sicher, dass du das Model `Article` oben im Controller einbindest mit `use App\Models\Article;`

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

    return view('messages.conversation', compact('user', 'messages', 'article', 'articleId')); // Füge 'articleId' zu den compact Variablen hinzu
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
}
