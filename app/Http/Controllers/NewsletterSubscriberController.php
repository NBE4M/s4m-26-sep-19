<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use DB;
use App\Right;
use App\SbuscriptionPackage;
use App\Subscriber;
use App\Channel;
use App\Country;
use App\State;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NewsletterSubscriberController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->rightObj = new Right();
    }

    public function index() {


        /* Right mgmt start */
        $rightId = 95;
        //$currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        $channels = $this->rightObj->getAllowedChannels($rightId);

        if (!$this->rightObj->checkRightsIrrespectiveChannel($rightId))
            return redirect('/dashboard');
        $subscriberChannel = 0;
        if (isset($_GET['channel'])) { // If channel id passed in get it will return that id
            $subscriberChannel = $_GET['channel'];
        }
        $channelIdArray = array();
        foreach ($channels as $channel) {
            $channelIdArray[] = $channel['channel_id'];
        }
        $query = DB::table('subscribe_newsletter')->orderby('id','desc');

        if (isset($_GET['keyword'])) {
            $queryed = $_GET['keyword'];
            $query->where(function ($query) use ($queryed) {
                $query->where('sub.first_name', 'LIKE', '%' . $queryed . '%')
                        ->orWhere('sub.first_name', 'LIKE', '%' . $queryed . '%')
                        ->orWhere('sub.email', 'LIKE', '%' . $queryed . '%');
            });

            //('sub.first_name', 'LIKE', '%' . $queryed . '%');
        }

        $subscribers = $query->paginate(config('constants.recordperpage'));
        //echo count($subscribers); exit;
        return view('contactus.index', compact('subscribers', 'channels', 'subscriberChannel'));
    }

     public function exportCsv(Request $request) {
         /* Right mgmt start */
        $rightId = 95;
        //$currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        $channels = $this->rightObj->getAllowedChannels($rightId);

        if (!$this->rightObj->checkRightsIrrespectiveChannel($rightId))
            return redirect('/dashboard');
        $subscriberChannel = 0;
        if (isset($_GET['channel'])) { // If channel id passed in get it will return that id
            $subscriberChannel = $_GET['channel'];
        }
        $channelIdArray = array();
        foreach ($channels as $channel) {
            $channelIdArray[] = $channel['channel_id'];
        }
        $query = DB::table('subscribe_newsletter')->orderby('id','desc');

        if (isset($_GET['keyword'])) {
            $queryed = $_GET['keyword'];
            $query->where(function ($query) use ($queryed) {
                $query->where('email', 'LIKE', '%' . $queryed . '%');
            });

            //('sub.first_name', 'LIKE', '%' . $queryed . '%');
        }
        
            $subscribers = $query->paginate(config('constants.recordperpage')); 
        $export_data="Email\n";
        foreach($subscribers as $sub){
            $export_data.=$sub->email."\n";
        }
        return response($export_data)
            ->header('Content-Type','application/csv')               
            ->header('Content-Disposition', 'attachment; filename="Subscriber.csv"')
            ->header('Pragma','no-cache')
            ->header('Expires','0');                     
       
       // echo count($subscribers); exit;
    }

}
