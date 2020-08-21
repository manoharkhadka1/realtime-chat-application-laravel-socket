<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user_messages() {
        return $this->hasMany(UserMessage::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_messages',
            'message_id', 'sender_id')
            ->withTimestamps();
    }
}
