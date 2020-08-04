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
                      'question'=>$request->input('question')
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
                      'question'=>$request->input('question')
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
            
			return redirect('admin/polls');
		}
    }
	
	public function unpublish($id)
    {
		if($id > 0){ 
			DB::table('poll_answer')->where('poll_id', $id)->update(['status' => 2]);
			DB::table('poll')->where('id', $id)->update(['status' => 2]);
			Session::flash('alertmessage', 'Poll is UnPublished');

			return redirect('admin/polls');
		}
    }
	public function deletes($id)
    {
		if($id > 0){ 
			DB::table('poll_answer')->where('poll_id', $id)->update(['status' => 3]);
			DB::table('poll')->where('id', $id)->update(['status' => 3]);
			Session::flash('alertmessage', 'Poll is UnPublished');
            
			return redirect('admin/polls');
		}
    }

    public function ansRemove($id)
    {
        DB::table('poll_answer')->where('id', $id)->delete();
        
        return redirect('admin/polls')->with('message','Poll Answer has Deleted.');
    }
	
}
