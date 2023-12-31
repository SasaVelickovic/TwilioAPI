<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Account;
use App\Model\Market;
use App\Model\Number;
use App\Model\Settings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class PhoneController extends Controller
{
    private $client = null;
    public function __construct() {
        $settings = Settings::first()->toArray();


        $sid = $settings['twilio_acc_sid'];

       $token = $settings['twilio_auth_token'];

        $this->client = new Client($sid, $token);
    }
    public function index(){
        try {

        $context = $this->client->getAccount();
        $activeNumbers = $context->incomingPhoneNumbers;
        $activeNumberArray = $activeNumbers->read();
        dd($activeNumberArray);
        // $callLogs = $this->client->calls->read([
        //     ["from" => '+14234608889'], // Match "from" number
        //     ["to" => '+14234608889'], // Match "from" number
        // ], 20, 1);
        $perPage = 5; // Number of records per page
        $fromRecords = $this->client->calls->read(["from" => '+14234608889'], $perPage, 1);
        $toRecords = $this->client->calls->read(["to" => '+14234608889'], $perPage, 1);
        $callLogs =  array_merge($fromRecords, $toRecords);
        $callRecords = $this->client->recordings->read();
        $callLogs = $this->client->calls->page( [], 20 );
        // dd($callLogs->calls);
        // $cla = null;
        $iterationCount = 0;  // Initialize the counter

        foreach ($callLogs as $call) {
            $cla = $call->sid;


        }
        dd($cla);

        echo $callLogs;
        //print_r($activeNumberArray);
        //die("...");
        $numbers = [];

        foreach($activeNumberArray as $activeNumber) {
            error_log('active number = '.$activeNumber->phoneNumber);
            $numbers[] = (object)[
                'number' => $activeNumber->phoneNumber,
                'name' => $activeNumber->friendlyName,
                'sid' => $activeNumber->sid,
                'capabilities' => $activeNumber->capabilities,
            ];

            $phn_num = $activeNumber->phoneNumber;
            $phone_number = Number::where('number', $phn_num)->first();
            $account = Account::first();
            $market = Market::first();

            if(!$phone_number)
            {
                $capabilitiesString = [];

                foreach ($activeNumber->capabilities as $capability => $value) {
                    if($value) {

                        $capabilitiesString[] = "$capability = true ";
                    }else{
                        $capabilitiesString[] = "$capability = false ";

                    }
                }
                $phn_nums = new Number();
                $phn_nums->number= $phn_num;
                $phn_nums->sid= $activeNumber->sid;
                $phn_nums->capabilities= json_encode($capabilitiesString);
                $phn_nums->a2p_compliance= $activeNumber->capabilities["sms"];
                $phn_nums->sms_allowed = Settings::first()->sms_allowed;
                $phn_nums->account_id = $account->id;
                $phn_nums->market_id=$market->id;
                $phn_nums->save();
            }
        }
      // var_dump($numbers);
      // print_r($numbers[0]->number);


       //die(".");
       $all_phone_nums=Number::all();
        return view('back.pages.phone.index', compact('all_phone_nums'));
        } catch (TwilioException $e) {
            // Handle the Twilio exception here
            // You can log the error, show an error message to the user, or perform any other necessary action.
            return response()->json(['error' => 'Twilio API error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other exceptions here
            // You can log the error, show an error message to the user, or perform any other necessary action.
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
}

    public function callRecords(Request $request){
        try {

        $page = $request->input('page', 1); // Get the requested page from the request or default to page 1
        $perPage = 5; // Number of records per page
        $fromRecords = $this->client->calls->read(["from" => $request->number], $perPage, $page);
        $toRecords = $this->client->calls->read(["to" => $request->number], $perPage, $page);
        $callLogs =  array_merge($fromRecords, $toRecords);
        $formattedCallLogs = [];
        foreach ($callLogs as $call) {
            $formattedCallLogs[] = [
                'from' => $call->from,
                'to' => $call->to,
                'direction' => $call->direction,
                'startTime' => $call->startTime,
                'status'    => $call->status
                // Add other fields you need
            ];
        }

            return response()->json(['success'=>'Status changed successfully.', 'data'=>$formattedCallLogs]);
        } catch (TwilioException $e) {
            return response()->json(['error' => 'Twilio API error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        $phn = Number::find($request->phn_id);
        $phn->is_active = $request->sts;
        $phn->save();
        return response()->json(['success'=>'Status changed successfully.']);
    }

    // Make calls test
    public function makeCallTesting()
    {
        // A Twilio number you own with Voice capabilities
        $twilio_number = "+14234609555";

        // Where to make a voice call (your cell phone?)
        $to_number = "+18183107612";

        $call = $this->client->calls->create(
            $to_number,
            $twilio_number,
            [
                'url' => 'http://demo.twilio.com/docs/voice.xml',
            ]
        );

        echo "Call SID: " . $call->sid;


    }
}
