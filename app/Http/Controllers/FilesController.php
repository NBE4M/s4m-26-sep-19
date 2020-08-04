<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadFiles;
use File;
use Storage;
use App\Http\Controllers\EventLogController;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploadfiles = UploadFiles::paginate(10);
        return view('files.files',compact('uploadfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = str_replace(' ', '-', $request->file('pdffiles')->getClientOriginalName());
        $filtername = preg_replace('/[^A-Za-z0-9\-,.]/', '', $name);
        $pdfName = date('d-m-Y').'-'.$filtername;
        $exeName = $request->file('pdffiles')->getClientOriginalExtension();
        $a = $request->file('pdffiles')->move(public_path('files/pdf'), $pdfName);
        Storage::disk('files')->put($pdfName,file_get_contents(config('constants.PDFfilespath').$pdfName),
                        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                        );
        $upfiles = new UploadFiles();
        $upfiles->file_caption = $request->fileName;
        $upfiles->file_name = $pdfName;
        $upfiles->file_exe = $exeName;
        $upfiles->valid = '1';
        $upfiles->save();
        $uid = $request->user()->id;
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'pdf_upload','description'=>$pdfName.' / '.'Pdf Upload','article_id'=>$upfiles->file_id]);
        File::delete(public_path("files/pdf/". $pdfName));
        return redirect('article/upload/files');
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

    public function videostore(Request $request)
    {
        $name = str_replace(' ', '-', $request->file('videofiles')->getClientOriginalName());
        $filtername = preg_replace('/[^A-Za-z0-9\-,.]/', '', $name);
        $videoName = date('d-m-Y').'-'.$filtername;
        $exeName = $request->file('videofiles')->getClientOriginalExtension();
        $request->file('videofiles')->move(public_path('files/video'), $videoName);
        Storage::disk('files')->put($videoName,file_get_contents(config('constants.Videofilespath').$videoName),
                        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                        );
        $upfiles = new UploadFiles();
        $upfiles->file_caption = $request->videoName;
        $upfiles->file_name = $videoName;
        $upfiles->file_exe = $exeName;
        $upfiles->valid = '1';
        $upfiles->save();
        $uid = $request->user()->id;
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'video_upload','description'=>$videoName.' / '.'Video Upload','article_id'=>$upfiles->file_id]);
        File::delete(public_path("files/video/". $videoName));
        return redirect('article/upload/files');
    }

    public function filesdestroy(Request $request,$name='', $id)
    { 
        $uid = $request->user()->id;
       Storage::disk('files')->delete($name);
       UploadFiles::where([['file_name',$name],['file_id',$id]])->delete();
       $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'file_delete','description'=>$name.' / '.'File Deleted','article_id'=>$id]);
       return redirect('article/upload/files');
    }
}
