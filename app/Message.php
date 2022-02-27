<?php

namespace App;

use App\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Message extends Model
{
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add($text, $userID, $chatID)
    {
        $message = new self;
        $text = Crypt::encryptString($text);
        $message->message = $text;
        $message->user_id = $userID;
        $message->chat_id = $chatID;
        $message->save();
        return $message;
    }

    public function remove()
    {
        return $this->delete();
    }

    public function getMessage()
    {
        return Crypt::decryptString($this->message);
    }
}
