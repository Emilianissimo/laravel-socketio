<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getCompanionName()
    {
        if($this->reciever_id == Auth::user()->id){
            return $this->sender->name;
        }
        return $this->reciever->name;
    }

    public function getCompanionID()
    {
        if($this->reciever_id == Auth::user()->id){
            return $this->sender->id;
        }
        return $this->reciever->id;
    }

    public static function add($senderID, $recieverID)
    {
        $isExists = self::where('sender_id', $senderID)->orWhere('reciever_id', $recieverID)->exists();
        
        if($isExists){
            return self::where('sender_id', $senderID)->orWhere('reciever_id', $recieverID)->first();
        }

        $chat = new self;
        $chat->sender_id = $senderID;
        $chat->reciever_id = $recieverID;
        $chat->save();

        return $chat;
    }

    public function remove()
    {
        return $this->delete();
    }
}
