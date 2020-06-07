<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Gate;
use App\Message;
use App\Events\NewMessage;
class ContactsController extends Controller
{
    // if the user is not logged in and tries to access the messages page, they will be redirected to the login back
    public function __construct(){
        $this->middleware('auth');
    }
        

    public function index(){
        return view('messages.index');

    }
    public function get()
    {
        // get all users except the one who is logged in / authenticated
        $contacts = User::where('id', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him/her
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            // we get all messages that are sent to the logged in user
            ->where('to', auth()->id())
            // and the messages that are not read
            ->where('read', false)
            // group all of them by the people who sent them
            ->groupBy('from')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            // return the id in the unreadIds collection or null
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            // if we have unread message, coun the unreadmessages
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

             return $contact;
        });


        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
         Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            // from is the person logged in
            $q->where('from', auth()->id());
            // this is the id we pass in as the method
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            //this is the opposite, get all messages that are sent to us from that id
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    // used in the ChatApp .vue, it used to create/store a new message from the user
    public function send(Request $request){
      
        $message =  Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);
        
        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
