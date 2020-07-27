<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Http\Request;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse returns a list of all users
     */
    public function getAllUsers(){
        $result = User::all();
        return response()->json($result);
    }

    /**
     * @param $id the user id
     * @return \Illuminate\Http\JsonResponse returns a single user JSON object
     */
    public function getSingleUser($id){
        try {
            $result = User::findOrFail($id);
        } catch (ModelNotFoundException $e){
            return response()->json("user not found with the id: " .$id, 404);
        }
        return response()->json($result);
    }

    /**
     *
     * get all messages sent to a user
     *
     * @param $id int the id of the user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($id){

        $messages = DB::table('messages')
            ->where('receiver', $id)
            ->get();

        return response()->json($messages);
    }

    /**
     *
     * finds the messages send to the user by a specific user
     *
     * @param $receiver_id  int the current user id
     * @param $sender_id int the id of  the sender of the message
     * @return \Illuminate\Http\JsonResponse json collection of the messages
     */
    public function getMessageBySender($receiver_id, $sender_id) {
            $messages = DB::table('messages')
                ->where('receiver', $receiver_id)
                ->where('sender', $sender_id)
                ->get();
            return response()->json($messages);
    }

    /**
     * gets all the users that send the current user a message
     * @param $id integer the user id
     * @return \Illuminate\Http\JsonResponse json response containing user objects
     */
    public function getChats($id){

        $users = User::where(function ($query) {
            $query->select('sender')
                ->from('messages')
                ->whereColumn('receiver', 'users.user_id');
        }, $id)->get();

        return response()->json($users);
    }

    /**
     * register a user in the chat application
     * @param Request $request request containing a user JSON object
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request) {

        $user = new User();
        $data = $request->json()->all();
        $user->fill($data);
        $result = $user->save();

        if($result){
            return response()->json($user,201);
        }
        return response()->json("failed to save user",500);
    }
}
