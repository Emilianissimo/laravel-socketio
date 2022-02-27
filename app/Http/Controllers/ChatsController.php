<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $users = User::select('id', 'name')->where('id', '!=',$currentUser->id)->get();
        $chats = Chat::where('reciever_id', $currentUser->id)->orWhere('sender_id', $currentUser->id)->orderBy('created_at', 'DESC')->get();
        return view('chats.index', compact('chats', 'users'));
    }

    public function store(Request $request)
    {
        $chat = Chat::add(
            Auth::user()->id,
            $request->get('reciever_id')
        );
        return redirect()->route('chats.show', $chat->id);
    }

    public function show($chatID)
    {
        $chat = Chat::find($chatID);
        $messages = $chat->messages()->orderBy('created_at', 'DESC')->get();
        return view('chats.show', compact('chat', 'messages'));
    }

    public function destroy($chatID)
    {
        Chat::find($chatID)->remove();
        return response()->noContent();
    }
}
