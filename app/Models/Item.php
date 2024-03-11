<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Definieren Sie hier die Attribute, die massenzuweisbar sind
    protected $fillable = [
        'title',
        'description',
        'price',
        'photo',
        'user_id', // Stellen Sie sicher, dass es eine Referenz zu einem User gibt, wenn Artikel benutzerbezogen sind
    ];

    // Wenn Sie Beziehungen definieren möchten, z.B. Artikel zu Benutzer
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
