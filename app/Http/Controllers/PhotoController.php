<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Album;
use App\Menu;
use View;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        

    public function index()
    {
        $ArrlistingPhotos  = Album::with('photo')->where('valid','1')->orderby('id','desc')->paginate(20);
        $metatitel = 'Photo, Image Gallery - Samachar4media';
        $ogtitel =  'Photo, Image Gallery - Samachar4media';
        $ogimage = '';
        $ogurl = '';
        $canonical = '';
        $metatag = 'media news photo gallery, marketing news image gallery, advertising news picture gallery';
        $metadescription = 'Samachar4media meida, advertising, photo, image, picture gallery page India.';
            // $arrmostread = $this->arrmostread;
            // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $menus = $this->menus;
            // $parents = $this->parents;
        return view('photogallery.photogallery_listing', compact('ArrlistingPhotos','ArrViewPhotos','metatitel','ogtitel','ogimage','ogurl','canonical','metadescription','parents','ogdescription','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecenttopnews','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo'));
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
        //
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
