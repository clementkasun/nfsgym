<?php

namespace App\Http\Controllers;

use App\Models\ShortMessage;
use Illuminate\Http\Request;

class ShortMessageController extends Controller
{

    public function index()
    {
        return view('sms_notify');
    }

    public function send_sms(Request $request)
    {

        $contacts = $request->input('contacts');
        $message = $request->input('message');

        if ($contacts == null || $message == null) {
            return array('status' => 0, 'SMS Notification sending has failed!');
        } else {
            foreach ($contacts as $contact) {
                // API URL
                $url = 'http://smsm.lankabell.com:4040/Sms.svc/SendSms?phoneNumber=' . $contact . '&smsMessage=' . $message . '&companyId=CEYTECHAPI394&pword=aQyp7glqK0';
                $status = file_get_contents($url);

                $message_save_status = ShortMessage::create([
                    "message" => $message,
                    "contact_no" => $contact,
                    "user_id" => auth()->user()->id,
                ]);
            }

            if ($status == true && $message_save_status == true) {
                return array('status' => 1, 'SMS Notification has been sent successfully!');
            } else {
                return array('status' => 0, 'SMS Notification sending has failed!');
            }
        }
    }
}
