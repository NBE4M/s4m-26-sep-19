<?php

namespace App\Http\Controllers;
use Redirect;
use App\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Right;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Article;
use Artisan;
use Mail;


class MailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->rightObj = new Right();
    }
    
    public function index()
    {
        $request=new Request();
        // $data=$request->all();
        //$t=Input::get();
        //dd($t); 
        
        /* Right mgmt start */
        
        $rightId = 8;
        $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($currentChannelId, $rightId))
            return redirect('/dashboard');
        /* Right mgmt end */ 
        $parentId=0;
        $parents=array();
        //echo '1'; exit;
        $query= DB::table('mailerreport')->select('*')->where('valid','=', '1')->orderby('mailer_id','desc');
        
        
       if(isset($_GET['keyword'])){
            $queryed = $_GET['keyword'];
            $query->where('subject', 'LIKE', '%'.$queryed.'%');
        }
        
        if(Input::get('id')){
          
            $parent=Mailer::find(Input::get('id'));
            $id=trim($parent->path,'-'); 
            $idArray=explode('-',$id);
            //echo '1';
            $parents=Mailer::select('mailer_id','name')->whereIn('mailer_id',$idArray)->get();
            //echo '444'.count($parents); exit;
        }
       
        $categories=$query->get();
        $uid = Session::get('users')->id;
        return view('categorymaster.mailermaster',compact('categories','channels','currentChannelId','parentId','parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rightId = 8;
        if(Input::get('id')){
            $parentId=Input::get('id');
            $currentChannelId=$this->getChannelFromCategoryId($parentId);
        }            
        else{    
            $parentId=0;
            $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        }    
        $channels = $this->rightObj->getAllowedChannels($rightId);
        
        $parents=array();
        
        if (!$this->rightObj->checkRights($currentChannelId, $rightId))
            return redirect('/dashboard');
       
       return view('categorymaster.addmailer',compact('channels','currentChannelId','parentId','parents'));
       
        //Save Request Tuple in Table - Validate First
        // ----- Not Being used for now ----//
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //echo $request->user()->id;
        ///print_r($request->all()); exit;
        
         /* Right mgmt start */
        $rightId = 8;
        if($request->parent_id)
            $currentChannelId =$this->getChannelFromCategoryId($request->parent_id);
        else
            $currentChannelId =$request->channel;
        
        
        if (!$this->rightObj->checkRights($currentChannelId, $rightId))
            return redirect('/dashboard');
        /* Right mgmt end */     
           
        $mailer=new Mailer();
        $mailer->subject=$request->subject;
        $mailer->link=$request->url;
        $mailer->create_date=$request->cdate;
        $mailer->sales_person_name=$request->salesp_name;
        $mailer->type=$request->type;
        $mailer->create_by=$request->emp_name;
        $mailer->valid='1';
        $mailer->save();
        Session::flash('message', 'Your data has been successfully add.');
            return Redirect::to('mailer');
       
    }
    
    function getChannelFromCategoryId(){
        return '1';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {
        echo 'edit';
        //
        //$asd = fopen("/home/sudipta/log.log", 'a+');
        if (isset($_GET['option'])) {
            $id = $_GET['option'];
        }
        //fwrite($asd, " EDIT ID Passed ::" .$id  . "\n\n");
        $editAuthor = Author::where('author_id',$id)
            ->select('authors.*')
            ->get();

        
        echo json_encode(array($editAuthor));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {   
        $delArr = explode(',', $id);
        foreach ($delArr as $d) {
            $valid='0';
            $deleteAl= [    
            'valid' => $valid  
            ];
            DB::table('mailerreport')
            ->where('mailer_id',$d)
            ->update($deleteAl);       
        }
        return;
    }

    protected function changeEnv($data = array())
    {
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }

    public function mailConfigIndex()
    {
        $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        
                foreach($mails as $key => $value){
                    $exp[] = explode("=", $value, 2);   
                }
        return view('emails.mailConfig',compact('exp'));
    }
    protected function changeMailFile($filedata = array())
    {
        if(count($filedata) > 0){

            // Read .env-file
            $mail = file_get_contents(base_path() . '/storage/app/public/mailDetails.txt');

            // Split string on every " " and write into array
            $mail = preg_split('/\s+/', $mail);

            // Loop through given data
            foreach((array)$filedata as $key => $value){

                // Loop through .env-data
                foreach($mail as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $mail[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $mail[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $mail = implode("\n", $mail);

            // And overwrite the .env with the new data
            file_put_contents(base_path().'/storage/app/public/mailDetails.txt', $mail);
            
            return true;
        } else {
            return false;
        }
    }

    public function mailFileUpdate(Request $request)
    {
        $env_update = $this->changeMailFile([
        'TO'       => $request->TO,
        'CC'       => $request->CC,
        'BCC'       => $request->BCC,
        ]);

        if($env_update){
           return redirect('mail/config');
        }
         else {
           return redirect('mail/config')->with('alert', 'Mails Added Failed!!');
        }
    }


 
}


