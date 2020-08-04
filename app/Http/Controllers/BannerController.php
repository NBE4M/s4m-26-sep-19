<?php

namespace App\Http\Controllers;
use Redirect;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Right;
use Auth;
use File;
use Config;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
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
    {   $parents = DB::table('banner')->orderBy('bid', 'DESC')->paginate(config('constants.recordperpage'));

        return view('categorymaster.banner',compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {  $parents=DB::select( DB::raw("SELECT * FROM banner order by bid desc"));
       return view('categorymaster.banner',compact('parents'));
       
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
            DB::insert('insert into banner (bposition,status,bscript,mobile,desktop,forpage) values (?,?,?,?,?,?)', [$request->channel,'1', $request->bscript,$request->mobile,$request->desktop,$request->channel1]);
            $parents=DB::select( DB::raw("SELECT * FROM banner order by bid desc"));
            return Redirect::to('cms/manageAds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    { $parents=DB::select( DB::raw("SELECT * FROM banner order by bid desc"));
        $parentsedit=DB::select( DB::raw("SELECT * FROM banner where bid= $id"));
        return view('categorymaster.editbanner',compact('parentsedit'));
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
       DB::table('banner')->where('bid', '=', $id )->update([
        'bscript' => $request->bscript, 
        'mobile' => $request->mobile, 
        'desktop' => $request->desktop, 
        'status' => $request->bstatus, 
         'forpage' => $request->channel1, 
        ]);  
        Session::flash('message', 'banner updated sucessfully.');
        return Redirect::to('cms/manageAds');
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
			'active' => $valid	
            ];
            DB::table('tbl_menu')
            ->where('id',$d)
            ->update($deleteAl);       
        }
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
        return;
    }

    public function editHtmlEntities()
    {
        $directory1 = Config::get('constants.storagepath').'css';
        $directory2 = Config::get('constants.storagepath').'js';
    
        $files1 = File::allFiles($directory1);
        $files2 = File::allFiles($directory2);
        // dd($files1);
        foreach ($files1 as $attachment1) {
            $attached1[] = pathinfo($attachment1,PATHINFO_BASENAME);
        } 
        foreach ($files2 as $attachment2) {
            $attached2[] = pathinfo($attachment2,PATHINFO_BASENAME);
        }
        return view('partials/htmlEntities',['css' =>$attached1,'js' =>$attached2]);
    }

   
}
