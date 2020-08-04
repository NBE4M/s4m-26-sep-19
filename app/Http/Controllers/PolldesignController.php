<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Poll;
use App\Models\Poll_Answer;
use App\Models\Poll_Result;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Images;

use App\Models\Article;

use App\Models\Editor;
use App\Models\Category;
use App\Models\Categories;

use App\Models\ArticleCategoryMapping;

use App\Models\RelatedArticles;

use App\Models\Tag;

use App\Models\ArticleTagMapping;

use App\Models\ArticleCategorySort;
use App\tbl_menu;
use Session;

use Response;

use View;

use DB;

class PolldesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // Cache::remember('pollsnew', 2, function() {
       //      return DB::table('poll')->where('status', '1')->orderBy('id', 'desc')->first();
       //      }); 
       //  $polls = Cache::get('pollsnew');
       // Cache::remember('poll_answer_new', 2, function() use($polls){
       //              return DB::table('poll_answer')->where('poll_id', $polls->id)->get();
       //              }); 
       //          $poll_answer = Cache::get('poll_answer_new'); 
       // $commanban = DB::table('bannerstore')->where([['master_banner_id','1'],['sub_banner_id','1']])->orderby('id','desc')->limit(1)->get();                 
       // View::share('polls',$polls);
       // View::share('poll_answer',$poll_answer); 
       // View::share('commanban',$commanban);                    
    }
    public function index()
    {
		// $this->pageTitle = "Poll  ";
	 
		// $polls = DB::table('poll')->where('status', '1')->where('id', '2')->get();
		// $poll_answer = DB::table('poll_answer')->where('poll_id', '2')->get();

		// return view('article_story')->with(['polls'=>$polls,'poll_answer'=>$poll_answer,'pageTitle'=>$this->pageTitle]);
        return redirect('/');
    }
	
	 public function pollsarchive(Request $request)
    {
		
		$pollarch = array();
		$polls = DB::table('poll')->where('status',2)->orderBy('id', 'desc')->get();
		foreach($polls as $k=> $pol)
		{
			$poll_answer = DB::table('poll_answer')->where('poll_id', $pol->id)->get();
			$sum = DB::table('poll_answer')->where('poll_id', $pol->id)->sum('vote');		
			
			if(count($poll_answer) > 0 ){
				$pollarch[$pol->id]['question'] = $pol->question;
				$pollarch[$pol->id]['sum'] = $sum;
				$pollarch[$pol->id]['anss']  = array();
				foreach($poll_answer as $ans)
				{
					$pollarch[$pol->id]['anss'][$ans->id]['answer'] = $ans->answer;
					$pollarch[$pol->id]['anss'][$ans->id]['vote'] = $ans->vote;
				}
				
			}
	
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($pollarch);
 
        // Define how many items we want to be visible in each page
        $perPage = 5;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
		}
		  if (Cache::has('menus')) {
                  $menus= Cache::get('menus');
                } else {
                  $menus = Category::where('parent_id','0')->where('is_homepage','1')->orderby('sequence','asc')->get();
                  Cache::put('menus', $menus, 10);
                }
		return view('pollarchive',['menus'=>$menus,'polls'=>$paginatedItems]);
      // return view('pollarchive')->with(['polls'=>$pollarch,'pageTitle'=>$this->pageTitle]);
	}

	public function pollsarchive_question()
    {
		$this->pageTitle = "Polls Archive";
		$pollarch = array();		
	//	$polls = DB::table('poll')->where('status', '1')->get();
		//$polls = DB::table('poll as p')->select('p.id')->leftJoin('poll_answer as pa', 'p.id', '=', 'pa.poll_id')->where('p.status', '1')->get();
		$polls = DB::table('poll as p')->leftJoin('poll_answer as pa', 'p.id', '=', 'pa.poll_id')->where('p.status', '1')->orderBy('p.id', 'desc')->take(15)->get();
		foreach($polls as $k=> $pol)
		{
			//$poll_answer = DB::table('poll_answer')->where('poll_id', $pol->id)->get();
			if($pol->poll_id > 0){
				$pollarch[$pol->poll_id]['poll_id'] = $pol->poll_id;
				$pollarch[$pol->poll_id]['question'] = $pol->question;
				$pollarch[$pol->poll_id]['ans'][$pol->id]['id'] = $pol->id;
				$pollarch[$pol->poll_id]['ans'][$pol->id]['answer'] = $pol->answer;
		   }
		}
		
		//$poll_answer = DB::table('poll_answer')->where('poll_id', '2')->get();
		//echo '<pre>';print_r($pollarch);echo '</pre>';exit;
		return view('pollarchive')->with(['polls'=>$pollarch,'pageTitle'=>$this->pageTitle]);
        
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->pageTitle = "Poll  ";
	 
		$polls = DB::table('poll')->where('status', '1')->orderBy('id', 'desc')->first();
		 
		$poll_answer = DB::table('poll_answer')->where('poll_id', $polls->id)->get();

		return view('article_story')->with(['polls'=>$polls,'poll_answer'=>$poll_answer,'pageTitle'=>$this->pageTitle]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInput = [ 'answer_id'=>$request->input('votes'),
					   'poll_id'=>$request->input('poll_id'),
					   'question_id'=>$request->input('poll_id'),
					   'ip'=>$_SERVER['REMOTE_ADDR'],
					   'result'=> '1'
					   
					   ];
        $rules      = [ 'votes'=>'required' ];

        $messages   = ['votes.required'=>'Answer Field is Required'  ];

	//  echo '<pre>';print_r($_POST);echo '</pre>'; exit;

        $validation=Validator::make($request->all(),$rules,$messages);

        if($validation->fails())
        {
            return Response::json(['error' => 'Answer Field is Required'], 401); // Status code here
        }
        else
        {
          $votes = DB::table('poll_result')->where('poll_id',$request->input('poll_id'))->where('ip',$_SERVER['REMOTE_ADDR'])->count();
		   if($votes > 0)
			  {
				 Session::flash('successpollmessage', 'you  already voted'); 					 
				// return redirect()->route('polldesign.create');		
                 return response()->json(['error' => 'you  already voted'], 402);		
			}else{			 
					$inserID=Poll_Result::insertGetId($userInput);
					if(isset($inserID) && (!empty($inserID)))
					{
							// $votes=null;
						 // $votes = [ 'vote'=>"vote"+1 ];

					  
						//$updateID=Poll_Answer::where('id',$request->input('votes'))->update($votes);
						$updateID=Poll_Answer::where('id',$request->input('votes'))->increment('vote');
						//echo count($answerList).'<pre>';print_r($answerList);echo '</pre>';exit;
                        
						 // Session::flash('successpollmessage', 'Thansk for Voting'); 
						 
						//return redirect()->route('slug');

                        return redirect()->back();
					} 
				else
				{
					Session::flash('alertmessage', 'Error Saving Poll!'); 
					Session::flash('alert-class', 'alert-danger'); 
					return redirect()->back();
				}

			}	
        }
    }

    /**
     * Display the specified Poll Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pollresult($id)
    {
		
		$this->pageTitle = "Poll  Result";
	
		$polls = DB::table('poll')->where('status', '1')->where('id', $id)->get();
		
		$poll_answer = DB::table('poll_answer')->where('poll_id', $id)->get();
		
		$sum = DB::table('poll_answer')->where('poll_id', $id)->sum('vote');

		if (Cache::has('menus')) {
                  $menus= Cache::get('menus');
                } else {
                  $menus = Category::where('parent_id','0')->where('is_homepage','1')->orderby('sequence','asc')->get();
                  Cache::put('menus', $menus, 10);
                }
		return view('polls/pollresult',compact('menus'))->with(['polls'=>$polls,'poll_answer'=>$poll_answer,'total_poll_answer'=>$sum]);
	}

    public function contactus()
    {
    	$menus = Category::where('parent_id','0')->where('is_homepage','1')->orderby('sequence','asc')->get();
        // $category = Categories::where('is_homepage','1')->where('valid',1)->whereNotIn('category_id',[12])->orderBy('sequence','asc')->get();
       
        return view('result',compact('menus'));
     
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
        //
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
        //
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
}
