<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            "phone_numbers" => "required"
        ]);
        $phone_numbers = explode(",",$request->phone_numbers);
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        
        try{
            for ($i=0;$i<count($phone_numbers);$i++) {
                if(!empty($phone_numbers[$i])){
                    $client->messages->create($phone_numbers[$i], ['from' => $twilio_number, 'body' => "Test messages"]);
                    if(($i+1) == count($phone_numbers))
                    {
                        return redirect('/')->with('success', 'SMS sent successfully');
                    }
                }
            }
        } catch(Exception $e){
            return $e->getMessage();
            return redirect('/')->with('error', $e->getMessage());
        }
    }
}
