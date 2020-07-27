<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Http\Request;

class MessageController extends Controller
{

    /**
     * @return \Illuminate\Support\Collection returns a list of all messages
     */
    public function getAllMessages(){

        $messages = DB::table('messages')->get();
        return $messages;
    }

    /**
     *
     * Sends a message by a user to another user
     *
     * @param Request $request a request containing a message JSON object
     * @return \Illuminate\Http\JsonResponse a confirmation or error response
     */
    public function sendMessage(Request $request){

        $message = new Message();

        $data = $request->json()->all();
        $message->fill($data);
        $timestamp = date("Y-m-d H:i:s");
        $message->fill(['timestamp' => $timestamp]);

        $result = $message->save();

        if($result){
            return response()->json($message,201);
        }

        return response()->json(null,500);
    }
}
