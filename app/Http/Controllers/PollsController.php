<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Poll;
use App\Poll_Answer;
use Session;

class PollsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    protected $polls              = null;  

    protected $tbl                  = null;

    protected $pageTitle            = null;
	
	
	 public function __construct()
    {
        Cache::forget('polls');
        Cache::forget('poll_answer');
        $this->forget();
        $this->polls              = new Poll();
        $this->tbl                  = "poll";
    }
	 
    public function index()
    {
		$this->pageTitle = "Poll List";
		 $polls = DB::table('poll')->where('status', '!=','3')->get();
         
		return view('polls.polls_list')->with(['polls'=>$polls,'pageTitle'=>$this->pageTitle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$this->pageTitle = "Add Poll";
		$answerList = array();
        return view('polls.poll')->with(['article_data'=>$this->polls,'pageTitle'=>$this->pageTitle,'answer'=>$answerList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInput = [ 'title'=>$request->input('title'),
                      'question'=>$request->input('question'),
                      'Hyperlink'=>$request->input('Hyperlink')
                     ];

        $rules      = ['title'=>'required',
                      'question'=>'required',
                     ];

        $messages   = ['title.required'=>'Poll Title Field is Required',

                      'question.required'=>'Poll Questtion' 
                     ];

	  

        $validation=Validator::make($request->all(),$rules,$messages);

        if($validation->fails())
        {
            return redirect()->back()->withInput($request->all())->withErrors($validation->errors());
        }
        else
        {
            $inserID=Poll::insertGetId($userInput);
            if(isset($inserID) && (!empty($inserID)))

            {
                $answerList=$request->input('answer');

                $answerArr=null;

                if(!empty($answerList) && count($answerList) > 0 )

                {                

                    for($i=0;$i<count($answerList);$i++)
                    { 
                        
                       $answerArr['poll_id']  = $inserID;

                        $answerArr['vote'] = '0';
                         $answerArr['answer'] = $answerList[$i];
                         
                        $article_cat_map_id = Poll_Answer::insertGetId($answerArr);

                    }
              }
              $this->forget();
                return redirect('admin/polls');
            }
            else
            {
                Session::flash('alertmessage', 'Error Saving Poll!'); 
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->back();
            }           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$answerList =Poll_Answer::where('poll_answer.poll_id',$id)->get();
		$polls= Poll::where('poll.id',$id)->get();
		$this->pageTitle = "Edit Poll";
        $this->forget();
        return view('polls.poll')->with(['article_data'=>$polls,'pageTitle'=>$this->pageTitle,'answer'=>$answerList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {	
		
		$userInput = [ 'title'=>$request->input('title'),
                      'question'=>$request->input('question'),
                      'Hyperlink'=>$request->input('Hyperlink')
                     ];

        $rules      = ['title'=>'required',
                      'question'=>'required',
                     ];

        $messages   = ['title.required'=>'Poll Title Field is Required',
                      'question.required'=>'Poll Questtion' 
                     ];	
	 
	    $validation=Validator::make($request->all(),$rules,$messages);			 
		if($validation->fails())
		{
			return redirect()->back()->withInput($request->all())->withErrors($validation->errors());
		}
		else
		{	
			$updateID=Poll::where('id',$id)->update($userInput);
			 $answerList=$request->input('answer');
             $answerArr=null;
			if(isset($updateID) && (!empty($updateID)))
            {
				if(!empty($answerList) && count($answerList) > 0 )					
                {
					foreach($answerList as $k=>$v)
                    {
						$answerArr['answer'] = $v;	
						$updatepollanswer=	Poll_Answer::where('poll_answer.id',$k)->where('poll_answer.poll_id',$id)->update($answerArr);	
                        if($updatepollanswer != 1)
						{
							$answerArr['poll_id']  = $id;
							$article_cat_map_id = Poll_Answer::insertGetId($answerArr);
						}

                    }
					
				}
			
			}
            $this->forget();			
			return redirect('admin/polls');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	public function publish($id)
    {
		if($id > 0){ 
			DB::table('poll_answer')->where('poll_id', $id)->update(['status' => 1]);
			DB::table('poll')->where('id', $id)->update(['status' => 1]);
			Session::flash('alertmessage', 'Poll is Published');
            $this->forget();
			return redirect('admin/polls');
		}
    }
	
	public function unpublish($id)
    {
		if($id > 0){ 
			DB::table('poll_answer')->where('poll_id', $id)->update(['status' => 2]);
			DB::table('poll')->where('id', $id)->update(['status' => 2]);
			Session::flash('alertmessage', 'Poll is UnPublished');
            $this->forget();
			return redirect('admin/polls');
		}
    }
	public function deletes($id)
    {
		if($id > 0){ 
			DB::table('poll_answer')->where('poll_id', $id)->update(['status' => 3]);
			DB::table('poll')->where('id', $id)->update(['status' => 3]);
			Session::flash('alertmessage', 'Poll is UnPublished');
            $this->forget();
			return redirect('admin/polls');
		}
    }

    public function ansRemove($id)
    {
        DB::table('poll_answer')->where('id', $id)->delete();
        $this->forget();
        return redirect('admin/polls')->with('message','Poll Answer has Deleted.');
    }

    public function forget() {
        $url= config('constants.SiteBaseurl').'/cache/clear';
        $data = array($url);
        $this->multiRequest($data);
}
    /*cron function*/
public function multiRequest($data, $options = array()) {
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
  // multi handle
  $mh = curl_multi_init();
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
    $curly[$id] = curl_init();
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
    curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curly[$id],CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
    // extra options?
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
 
    curl_multi_add_handle($mh, $curly[$id]);
  }
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }
  // all done
  curl_multi_close($mh);
  return $result;
}

	
}
