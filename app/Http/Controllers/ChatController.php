<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessagePosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FBReviews;

class ChatController extends Controller
{
    public function home() {
        $reviwes = FBReviews::getByUrl("https://www.facebook.com/AsdfTest2-1971208116484194/");
        return view('home', ['reviwes' => $reviwes]);
    }
    
    public function messagesGet(Request $request) {
        return Message::with('user')->get();
    }

    public function messagesPost(Request $request) {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => ! empty($request['message']) ? $request['message'] : '',
            'attach' => ! empty($request['attach']) ? $request['attach'] : '',
            'is_code' => ! empty($request['is_code']) ? true : false
        ]);
        
        broadcast(new MessagePosted($message, $user))->toOthers();
    }

    public function attachFile(Request $request) {
        return ['path' => $request['file']->store("public/attachs")];
    }
}