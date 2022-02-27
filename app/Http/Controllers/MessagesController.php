<?php

namespace App\Http\Controllers;

use PRedis;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    public function store(Request $request, $chatID)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);
        $message = Message::add(
            $request->get('message'),
            Auth::user()->id,
            $chatID
        );

        // Sending to redis
        $redis = PRedis::connection();
        $data = [
            'id'         => $message->id,
            'message'    => $message->getMessage(),
            'user_name'  => $message->user->name,
            'user_id'    => $message->user->id,
            'created_at' => $message->created_at->format('d F, Y'),
        ];

        $redis->publish('message', json_encode($data));

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function destroy($chatID, $messageID)
    {
        Message::find($messageID)->remove();
        return response()->noContent();
    }
}
