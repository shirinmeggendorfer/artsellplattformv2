<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item; 

class Message extends Model
{
    use HasFactory;
  
    protected $fillable = ['sender_id', 'recipient_id', 'body','article_id'];

    
    // Ruft den Sender der Nachricht ab.
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    //Verknüpfung Artikel und nachricht
    public function article()
{
    return $this->belongsTo(Item::class, 'article_id');
}


    // Ruft den Empfänger der Nachricht ab.
     
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}




