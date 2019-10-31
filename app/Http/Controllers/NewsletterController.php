<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribePending($request->email);
            return back()->with('success', 'Thanks For Subscribe');
        }
        return back()->with('failure', 'Sorry! You have already subscribed ');
    }

    public function sendCampaigns()
    {
        $newsletter_subject = 'Test Campaign';
        $newsletter_html = '<p>Hello welcome</p>';
        $api = Newsletter::getApi();
        //dd($api);
        $list_id = $api->get('lists')['lists'][0]['id'];
        //$result = $api->send($list_id, $newsletter_subject, $newsletter_html);


        $data = array(
            "recipients" => array("list_id" => $list_id),
            "type" => "regular", "settings" => array(
                "subject_line" => "New Stories for your Kids",
                "title" => "New Stories", "reply_to" => "gyelmis@gmail.com", "from_name" => "Kidstories",
                //"folder_id" => "8888969b77"
            )
        );
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            //Sample url
            CURLOPT_URL => "https://us5.api.mailchimp.com/3.0/campaigns",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "authorization: apikey 21c94500de8fd89aad9e26fc15c3e7ed-us5"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $response = $err;
        }

        dd($response);


        // if ($result['errors'])
        //     return back()->withErrors($result['errors']);
    }
}
