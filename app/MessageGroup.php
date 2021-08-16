<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageGroup extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function message_group_members() {
        return $this->hasMany(MessageGroupMember::class);
    }

    public function user_messages() {
        return $this->hasMany(UserMessage::class);
    }
}
