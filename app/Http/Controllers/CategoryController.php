<?php

namespace App\Http\Controllers;
use Redirect;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Right;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        
        $rightId = 75;
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
        /* Right mgmt end */ 
        $parentId=0;
        $parents=array();
        //echo '1'; exit;
        $query= DB::table('category')
                ->join('users', 'users.id', '=', 'category.user_id')
		->select('category.*','category.category_id','users.id','users.name as userssname'  )
                ->where('category.valid', '=', '1');
        
        if(Input::get('id')){ 
            $parentId=Input::get('id');
            $query->where('category.parent_id',$parentId);
        }else{
            $query->where('category.parent_id','0');
        }
       
       if(isset($_GET['keyword'])){
            $queryed = $_GET['keyword'];
            $query->where('category.name', 'LIKE', '%'.$queryed.'%');
        }
        
        if(Input::get('id')){
          
            $parent=Category::find(Input::get('id'));
            $id=trim($parent->path,'-'); 
            $idArray=explode('-',$id);
            $parents=Category::select('category_id','name')->whereIn('category_id',$idArray)->orderBy('level')->get();
        }
       
        $categories=$query->get();
        $uid = Session::get('users')->id;
        return view('categorymaster.categorymaster',compact('categories','parentId','parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $rightId = 75;
        if(Input::get('id')){
            $parentId=Input::get('id');
            // $currentChannelId=$this->getChannelFromCategoryId($parentId);
        }            
        else{    
            $parentId=0;
            // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        }    
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        
        $parents=array();
        if(Input::get('id')){
            $parent=Category::find(Input::get('id'));
            $id=trim($parent->path,'-'); 
            $idArray=explode('-',$id);
            //echo '1';
            $parents=Category::select('category_id','name')->whereIn('category_id',$idArray)->orderBy('level')->get();
        }
        
        
        
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
       
       return view('categorymaster.addcategory',compact('channels','currentChannelId','parentId','parents'));
       
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category|max:255',
            'e_name' => 'required|unique:category|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //echo $request->user()->id;
        ///print_r($request->all()); exit;
        
         /* Right mgmt start */
        $rightId = 75;
        // if($request->parent_id)
        //     $currentChannelId =$this->getChannelFromCategoryId($request->parent_id);
        // else
        //     $currentChannelId =$request->channel;
        
        
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
        /* Right mgmt end */     
           
        $category=new Category();
        $category->name=$request->name;
        $category->e_name=str_slug($request->e_name);
        $category->mtitle=$request->mtitle;
        $category->mdesc=$request->mdesc;
        $category->mkeyword=$request->mkeyword;
        $category->is_homepage=$request->is_homepage;
        $category->label=$request->bannerLabel;
        $category->breadcrumb=$request->bannerBreadCrumb;
        $category->parent_id=$request->parent_id;
        $category->user_id=$request->user()->id;
        $category->save();
        
        $id = $category->category_id;
        if($request->parent_id){
            
            $parent=  Category::find($request->parent_id);
            $category->path=$parent->path.$id.'-';
            // $category->level=$parent->level+1;
            
        }else{
            $category->path="-$id-";
            // $category->level=0;
        }
        $category->update();
        Cache::forget('menus');
        Session::flash('message', 'Your Category has been successfully add.');
        if($request->parent_id)
            return Redirect::to('category?id='.$request->parent_id);
        else
            return Redirect::to('cms/category');
       
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
         $rightId = 75;
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
        if(Input::get('id')){
            $parent=Category::find(Input::get('id'));
            $id=trim($parent->path,'-'); 
            $idArray=explode('-',$id);
            //echo '1';
            $parents=Category::select('category_id','name')->whereIn('category_id',$idArray)->orderBy('level')->get();
            //echo '444'.count($parents); exit;
        }

        $category=Category::find($id);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
       
       return view('categorymaster.editcategory',compact('channels','currentChannelId','parentId','parents','category'));
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
      DB::table('category')->where('category_id', '=', $id )->update([
        'name' => $request->name,
        'e_name' => $request->e_name,
        'mtitle' => $request->mtitle,
        'mdesc' => $request->mdesc,
        'mkeyword' => $request->mkeyword,
        'valid' => $request->valid,
        ]);
      // DB::table('tbl_menu')->where('slug', '=', $request->e_name )->update([
      //   'title' => $request->name,
      //   'slug' => $request->e_name 
      //   ]);    
        Session::flash('message', 'category updated sucessfully.');
        return Redirect::to('cms/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        if (isset($_GET['option'])) {
            $id = $_GET['option'];
            
        }
           // echo $id; die;
        //fwrite($asd, " Del Ids: ".$id." \n\n");
        $delArr = explode(',', $id);
        //fwrite($asd, " Del Arr Count: ".count($delArr)." \n\n");
        foreach ($delArr as $d) {
            //fwrite($asd, " Delete Id : ".$d." \n\n");
            $valid='0';
            $deleteAl= [
			
			'valid' => $valid
			
            ];
            DB::table('category')
            ->where('category_id',$d)
            ->update($deleteAl);
            
        }
        return;
    }
     
   
}
