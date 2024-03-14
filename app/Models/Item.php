<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'price',
        'photo',
        'user_id', 
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
{
    return $this->hasMany(Message::class, 'article_id');
}
public function items()
{
    return $this->hasMany(Item::class);
}



}
