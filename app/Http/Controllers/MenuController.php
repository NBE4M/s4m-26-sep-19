<?php

namespace App\Http\Controllers;
use Redirect;
use App\Menu;
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

class MenuController extends Controller
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
        $rightId=75;
       
        $parentId=0;
        $parents=array();
        //echo '1'; exit;
        $query= Menu::select('tbl_menu.*' )->orderby('ordering','asc');

       if(isset($_GET['keyword'])){
            $queryed = $_GET['keyword'];
            $query->where('title', 'LIKE', '%'.$queryed.'%');
        }
        
        if(Input::get('id')){
          
            $parent=Menu::find(Input::get('id'));
            $id=trim($parent->path,'-'); 
            $idArray=explode('-',$id);
           
            $parents=Menu::select('id','title')->whereIn('id',$idArray)->orderBy('id')->get();
            //echo '444'.count($parents); exit;
        }
       
        $menus=$query->get();
        return view('categorymaster.menu',compact('menus','parentId','parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {  
       $parents=Menu::select('id','title')->orderBy('id','desc')->get();
       return view('categorymaster.addmenu',compact('parents'));      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    
        $category= new Menu();
        $category->title=$request->title;
        $category->slug = $request->slug;
        $category->parent_id=$request->parent_id; 
        $category->active='1'; 
        $category->link=$request->place;
        $category->mtitle=$request->mtitle;
        $category->mdesc=$request->mdesc;
        $category->mkeyword=$request->mkeyword;
        $category->save();
        Cache::forget('menus');
        Session::flash('message', 'Your data has been successfully add.');
            return Redirect::to('cms/menu');
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
        $parents=Menu::select('id','title')->orderBy('id','desc')->get();
        $menue=Menu::find($id);
        return view('categorymaster.editmenu',compact('menue','parents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
         $menus=Menu::find($request->menu_id);
         $menus->title=$request->title;
         $menus->parent_id=$request->parent_id;
         $menus->slug=$request->slug;
         $menus->link=$request->place;
         $menus->mtitle=$request->mtitle;
         $menus->mdesc=$request->mdesc;
         $menus->mkeyword=$request->mkeyword;
         $menus->update();
         Cache::forget('menus');
         Session::flash('message', 'menu updated sucessfully.');
         return Redirect::to('cms/menu');
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
                $user = Menu::find($d);    
                $user->delete();   
        }
        Cache::forget('menus');
        return;
    }
    public function updatestatus(Request $request)
    {   
        if ($request->type=='Active') {
           $valid=0;
        }else{
            $valid=1;
        }
            
            $deleteAl= [    
            'active' => $valid  
            ];
            DB::table('tbl_menu')
            ->where('id',$request->id)
            ->update($deleteAl); 
            Cache::forget('menus');      
        return;
    }

       public function sortMenu($id,Request $request) {
        
        $newLetterId=$id;
        foreach($request->item as $k => $itm){
            $newsLetterArticle=Menu::find($itm);
            $newsLetterArticle->ordering=$k+1;
            $newsLetterArticle->updated_at = date('Y-m-d H:i:s');
            $newsLetterArticle->save();
        }
        
        
        $newsletter=Menu::find($newLetterId);
        $newsletter->updated_at=date('Y-m-d H:i:s');
        $newsletter->update();
        Cache::forget('menus');
        Session::flash('message', 'Your Order has been successfully Chnaged.');
            return Redirect::to('menu');
       
    }
     
   
}
