<?php
namespace App\Http\Controllers;


use Config;
use Illuminate\Http\Request;

use Storage;

use App\Http\Requests;

use Illuminate\Support\Facades\Response;

use App\Models\Article;

use App\Models\NewsletterType;
use App\Models\NewsletterArchive;
use App\MOdels\Newsletter;

use App\Models\NewsletterArticleMapping;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;

use Session;





class NewsletterhController extends Controller

{

   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

         

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response
        ['error' => 'Answer Field is Required'], 401
     */
    public function create(Request $request)
    {  
        
        if (!Session::has('users')) {
                    return redirect()->intended('/auth/login');
                }
        // $detectMorning = DB::table('events_logs')->where([['event_date',date("Y-m-d")],['description','Morning Post Final Newsletter has been sent']])->first(); 
        // $detectEvening = DB::table('events_logs')->where([['event_date',date("Y-m-d")],['description','Evening Post test Newsletter has been sent']])->first(); 
        // if($detectMorning){
        //     return Response::json(['error' => 'Morning Newsletter already released'],407);
        // }
        // if($detectEvening){
        //      return Response::json(['error' => 'Evening Newsletter already released at'],408);
        // }    
        $fname   = date('d-m-Y');
        if (empty($request->id)) {
        $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/morning-post-".$fname.".html";
        // $fh1 = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/news-update-".$fname.".html";
        // $fh2 = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/afternoon-post-".$fname.".html";
        $fh2 = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/evening-post-".$fname.".html";
        $fh1 = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/breaking-post-".$fname.".html";
        $ch = curl_init();
        $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/morningnewsletter.html');
        // $url1 = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/newsupdatenewsletter.html');
        // $url2 = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/afternoonnewsletter.html');
        $url2 = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/eveningnewsletter.html');
        $url1 = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/breakingnewsletter.html');
        if(!function_exists('curl_init')){
        return 'Sorry cURL is not installed!';
        }
        file_put_contents( $fh, $url);
        file_put_contents( $fh1, $url1);
        file_put_contents( $fh2, $url2);
        // file_put_contents( $fh3, $url3);
        // file_put_contents( $fh4, $url4);
        Storage::disk('newsletter')->put('morning-post-'.$fname.'.html',
        file_get_contents(public_path()."/newsletterhtml/morning-post-".$fname.".html"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );

        // Storage::disk('newsletter')->put('news-update-'.$fname.'.html',
        // file_get_contents(public_path()."/newsletterhtml/news-update-".$fname.".html"),
        // \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        // );

        // Storage::disk('newsletter')->put('afternoon-post-'.$fname.'.html',
        // file_get_contents(public_path()."/newsletterhtml/afternoon-post-".$fname.".html"),
        // \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        // );

        Storage::disk('newsletter')->put('evening-post-'.$fname.'.html',
        file_get_contents(public_path()."/newsletterhtml/evening-post-".$fname.".html"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );

        Storage::disk('newsletter')->put('breaking-post-'.$fname.'.html',
        file_get_contents(public_path()."/newsletterhtml/breaking-post-".$fname.".html"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
                }else{
        if ($request->id=='1') {
         $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/morning-post-".$fname.".html";
         $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/morningnewsletter.html');
         $name = "morning-post-".$fname.".html";
         $newsletter = 'Morning Newsletter';
         $this->store($newsletter,$name,$fname,$request->id);
        }
        // if ($request->id=='2') {
        // $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/news-update-".$fname.".html";
        // $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/newsupdatenewsletter.html');
        // $name = "news-update-".$fname.".html";
        // }
        // if ($request->id=='3') {
        //    $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/afternoon-post-".$fname.".html";
        //   $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/afternoonnewsletter.html');
        //   $name = "afternoon-post-".$fname.".html";
        // }
        if ($request->id=='3') {
          $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/eveningnewsletter.html');
           $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/evening-post-".$fname.".html";
           $name = "evening-post-".$fname.".html";
           $newsletter = 'Evening Newsletter';
            $this->store($newsletter,$name,$fname,$request->id);
        }
        if ($request->id=='2') {
            $fh = $_SERVER['DOCUMENT_ROOT'] . "/newsletterhtml/breaking-post-".$fname.".html";
         $url = file_get_contents(Config::get('constants.SiteBaseurl').'newsletter/breakingnewsletter.html');
         $name = "breaking-post-".$fname.".html";
         $newsletter = 'Breaking Newsletter';
        $this->store($newsletter,$name,$fname,$request->id);
        }
        $ch = curl_init();
        if(!function_exists('curl_init')){
        return 'Sorry cURL is not installed!';
        }
        file_put_contents( $fh, $url);
        Storage::disk('newsletter')->put($name,
        file_get_contents(public_path()."/newsletterhtml/".$name),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
        }

        return back();
}


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store($name,$filename,$pdate,$newsletterid)

    {

    NewsletterArchive::create([
            'newsletter_name' => $name,
            'filename' => $filename,
            'published_date' => $pdate,
            'newsletter_id' => $newsletterid
        ]);

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

    public function uploadimg(Request $request)
    {
      $image = $request->file('select_file');
      if ($image->getClientOriginalExtension() !=='png') {
        return redirect()->back()->with('msg','PLEASE UPLOAD PNG FILE');
      }else{
      $new_name = 'mheader.'.$image->getClientOriginalExtension();
      $image->move(public_path('images'), $new_name);
      Storage::disk('newsletter')->put(
                $new_name,
                file_get_contents(public_path('images/').$new_name),
                \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                );
      return redirect()->back()->with('msg','Image Upload Successfully');
     }
 }  

    

}

