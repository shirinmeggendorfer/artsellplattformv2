<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'recipient_id', 'body', 'article_id', 'is_read'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function article()
    {
        return $this->belongsTo(Item::class, 'article_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Bestimmt, ob die Nachricht vom authentifizierten Benutzer ungelesen ist.
     *
     * @return bool
     */
    public function isUnreadByAuthUser()
{
    // Überprüft, ob die Nachricht ungelesen ist und der Empfänger der authentifizierte Benutzer ist
    return $this->is_read === false && $this->recipient_id === auth()->id();
}
}