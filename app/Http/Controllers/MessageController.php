<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    // Formular anzeigen
    public function create(User $recipient)
    {
        return view('messages.create', compact('recipient'));
    }

   
    public function store(Request $request)
{
    $request->validate([
        'recipient_id' => 'required|exists:users,id',
        'message' => 'required',
    ]);

    $message = new Message();
    $message->sender_id = auth()->id();
    $message->recipient_id = $request->recipient_id;
    $message->body = $request->message;
    $message->save();

    return redirect()->route('messages.index')->with('success', 'Nachricht erfolgreich gesendet.');
}



public function index()
{
    $userId = auth()->id();

    // Hol dir alle Benutzer, mit denen der aktuelle Benutzer eine Konversation hat,
    // und füge die neueste Nachricht jeder Konversation hinzu
    $conversations = User::whereHas('sentMessages', function($query) use ($userId) {
        $query->where('recipient_id', $userId);
    })->orWhereHas('receivedMessages', function($query) use ($userId) {
        $query->where('sender_id', $userId);
    })->get()->each(function($user) use ($userId) {
        $user->latestMessage = Message::where(function($query) use ($userId, $user) {
            $query->where('sender_id', $userId)->where('recipient_id', $user->id);
        })->orWhere(function($query) use ($userId, $user) {
            $query->where('sender_id', $user->id)->where('recipient_id', $userId);
        })->latest()->first();
    });

    return view('messages.index', compact('conversations'));
}

public function conversation(User $user)
{
    $messages = Message::where(function($query) use ($user) {
                        $query->where('sender_id', auth()->id())->where('recipient_id', $user->id);
                    })
                    ->orWhere(function($query) use ($user) {
                        $query->where('sender_id', $user->id)->where('recipient_id', auth()->id());
                    })
                    ->orderBy('created_at')
                    ->get()
                    ->groupBy(function($date) {
                        // Gruppiere nach Datum
                        return Carbon::parse($date->created_at)->format('Y-m-d'); // Gruppiert nach Datum im Format Jahr-Monat-Tag
                    });

    return view('messages.conversation', compact('user', 'messages'));
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
