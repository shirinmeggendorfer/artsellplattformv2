<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    use HasFactory;

  
    protected $fillable = ['sender_id', 'recipient_id', 'body'];

    
    // Ruft den Sender der Nachricht ab.
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    
    // Ruft den Empfänger der Nachricht ab.
     
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}



