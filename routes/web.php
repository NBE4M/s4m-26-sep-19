<?php

Route::group(array('domain' => 'uat.{subdomain}.samachar4media.com'), function () {

    Route::get('/', function ($subdomain) {if ($subdomain=='cms')
        {return view('auth/login');route::auth();
    }else{
    		
        return App::call('App\Http\Controllers\Index\IndexpageController@index');
    
    }});
});

Route::get('auth/login', function () {
return redirect('/');
});
Route::get('login-news.html', function () {
return redirect('/');
});
// Amp article - Module Start
Route::get('{section}/{title}-{id}.html/amp','Index\IndexpageController@Amp_Article_landing_page')->where('section', '(.*)')->where('title', '(.*)');

// Amp article - Module End
// Front Site Routes ---------------------------------------------------
Route::paginate('{section}-news.html','Index\IndexpageController@section')->where('section', '(.*)');
Route::get('{section}-news', function($section){
        $href = "https://www.samachar4media.com/".$section."-news.html";
        return Redirect::to($href, 301);
})->where('section', '(.*)');
Route::get('{section}/{title}-{id}.html','Index\IndexpageController@story')->where('title', '(.*)');
Route::get('{string}','Index\IndexpageController@oldStoryRedirect');
Route::get('/news/contact.html', 'Index\IndexpageController@Contactus');
Route::paginate('news/videos.html','Index\IndexpageController@videoGallery');

Route::get('news/video/{title}-{id}','Index\IndexpageController@videoExplore')->where(['title'=> '(.*)','id' => '[0-9]+']);

Route::paginate('news/photos.html','Index\IndexpageController@photogallery');
Route::get('news/photo/{title}-{id}','Index\IndexpageController@galleryExplore')->where(['title'=> '(.*)','id' => '[0-9]+']);
Route::get('news/news/photos.html', function(){
        $href = "https://www.samachar4media.com/news/photos.html";
        return Redirect::to($href, 301);
});
Route::get('news/video', function(){
        $href = "https://www.samachar4media.com/news/videos.html";
        return Redirect::to($href, 301);
});
// Poll -  Front Module
Route::paginate('poll/result/{id}','Index\IndexpageController@pollresult');
Route::get('polls/archive.html','Index\IndexpageController@pollArchive');
// Tags  - Module
Route::get('/news/tags.html','Index\IndexpageController@tags');
Route::post('/tags/list/{name}','Index\IndexpageController@tags_list');
Route::paginate('tags/{uri}/name.html','Index\IndexpageController@Tag_wise_Article_listing_page');
// Author  -  Module
Route::paginate('news/author.html','Index\IndexpageController@Authorrepo_listing_page');
Route::paginate('author/{name}-{id}','Index\IndexpageController@Author_wise_Article_listing_page')->where('name', '(.*)');
Route::get('news/sitemap.html', 'Index\IndexpageController@sitemap');
Route::get('news/privacy.html', 'Index\IndexpageController@privacy');
Route::get('news/subscribe.html', 'Index\IndexpageController@subscriber');
Route::post('newsletter_subscribe','LetterController\LetterController@sub_newsletter');

Route::get('delete/breaking','Index\IndexpageController@breakingNewsDelete');
// Newsletter Module Start
Route::get('newsletter/afternoonnewsletter.html','LetterController\LetterController@Afternoon_Post_page');
Route::get('newsletter/eveningnewsletter.html','LetterController\LetterController@Evening_Post_page');
Route::get('newsletter/breakingnewsletter.html','LetterController\LetterController@Breaking_News_page');
Route::get('newsletter/newsupdatenewsletter.html','LetterController\LetterController@News_Update_page');
Route::get('newsletter/morningnewsletter.html','LetterController\LetterController@Morning_N_Page_New4');
Route::get('newsletter/{id}/archive.html','Index\IndexpageController@newsletterArchive');
// Newsletter Module End
/* Search Bar Autocomplete */
Route::get('news/autoComplete', 'Index\IndexpageController@autoComplete');
Route::paginate('search/{result}', 'Index\IndexpageController@searcharticle');
Route::paginate('tags/{result}', 'Index\IndexpageController@tagarticle');

/* Search Bar Autocomplete */
/*live data*/
Route::get('livedata1', function () {
$video = DB::table('youtubevideo')->select()->orderby('publish_date','desc')->paginate(config('constants.recordperpage'));
return view('video/video',compact('video'));
});
Route::get('live/Data/all','Index\IndexpageController@liveYoutubeData');

/*live data*/
route::auth();
Route::get('cms/dashboard', ['middleware' => 'auth',   'uses' => function () {
$posts = DB::table('articles')
        ->join('authors', 'articles.author_id', '=', 'authors.author_id')
        ->select('articles.article_id','articles.author_id','authors.*'  )
        ->where('articles.status', '=', 'p')
        ->orderBy('articles.article_id', 'desc')
        ->groupBy('authors.author_id','articles.article_id')
        ->take(5)->get();

 $article_publish = DB::table('articles')
         ->select('articles.*')
         ->where('articles.status', '=', 'p')
         ->count();
 $photos_publish = DB::table('photos')
         ->select('photos.*')
         ->where('photos.valid', '=', '1')
         ->count();
 $videos_publish = DB::table('youtubevideo')
         ->select('youtubevideo.*')
         ->count();
    return view('layouts.dashboard',compact('posts','article_publish','photos_publish','videos_publish') );
}]);




// Article - Module
Route::get('article/create', ['middleware' => 'auth',   'uses' => 'ArticlesController@create']);
Route::post('article', ['middleware' => 'auth',   'uses' => 'ArticlesController@store' ]);
Route::get('article/{id}','ArticlesController@show');

Route::get('checkschudelar','ArticlesController@checkschudelar');

// Album  - Module
Route::resource('cms/album', 'AlbumController');
Route::post('album/updates', 'AlbumController@albumUpdate');
// Video  - Module
Route::resource('video', 'VideoController');
// Route::get('video/create', ['middleware' => 'auth',   'uses' => 'VideoController@create']);
// Menu  -  Module
Route::resource('cms/menu', 'MenuController');
//CMS Rights - Management
Route::resource('cms/rights', 'RightsController');

Route::post('rights/manage', ['middleware' => 'auth',   'uses' => 'RightsController@update' ]);
Route::match(['get', 'post'], '/rights/delete', ['as' => '/rights/delete', 'uses' => 'RightsController@destroy']);
// Poll  -  Modules 
Route::resource('admin/polls','PollsController');
Route::get('admin/polls/{id}/publish','PollsController@publish');
Route::get('admin/polls/{id}/unpublish','PollsController@unpublish');
Route::get('admin/polls/{id}/delete','PollsController@deletes');
Route::get('polls/answer/{id}/remove','PollsController@ansRemove');
Route::post('polldesign','PolldesignController@store');
//  Preview Story - Module 
Route::get('tags/getJson',['middleware' => 'auth', 'uses' => 'TagsController@returnJson']);
//  Breaking News - Modules
Route::get('breaking/article', ['middleware' => 'auth',   'uses' => 'ArticlesController@breakingNews']);
Route::get('edit/htmlEntities', ['middleware' => 'auth',   'uses' => 'BannerController@editHtmlEntities']);
Route::post('breaking-news/store', ['middleware' => 'auth',   'uses' => 'ArticlesController@breakingNewsStore']);

Route::post('breaking/update', ['middleware' => 'auth',   'uses' => 'ArticlesController@breakingNewsEdit']);
//  Breaking News - Modules End
//  Mail Config - Modules
Route::get('mail/config', ['middleware' => 'auth',   'uses' => 'MailerController@mailConfigIndex']);
Route::post('mail/config/update','MailerController@mailFileUpdate');
//  Mail Config - Modules  End

Route::get('article/list/{option}', ['middleware' => 'auth',   'uses' => 'ArticlesController@index']);
Route::get('article/priority', ['middleware' => 'auth',   'uses' => 'ArticlesController@setpriority']);
Route::post('article/update', ['middleware' => 'auth',   'uses' => 'ArticlesController@update' ]);
Route::post('article/image/upload', ['middleware' => 'auth','uses' => 'ArticlesController@imageUpload']);
Route::get('article/image/upload',['middleware' => 'auth','uses' => 'ArticlesController@imageUpload']);
Route::post('article/image/dropzoneUploadFil',['middleware' => 'auth','uses' => 'ArticlesController@dropzoneUploadFile']);
Route::get('article/image/edit',['middleware' => 'auth','uses' => 'ArticlesController@imageEdit']);
Route::post('article/image/update',['middleware' => 'auth','uses' => 'ArticlesController@storeImageDetail']);
Route::post('article/sort/{id}','ArticlesController@sortImage');
Route::post('priority/sort','ArticlesController@sortarticle');
Route::post('priority/sortf','ArticlesController@sortfarticle');
Route::post('priority/sortC','ArticlesController@sortCarticle');
Route::post('cms/article', ['middleware' => 'auth',   'uses' => 'ArticlesController@store' ]);
Route::get('article/publish/scheduled','EventLogController@publishScheduledArticle');
Route::post('article/relatedimage', ['middleware' => 'auth','uses' => 'ArticlesController@relatedImage' ]);
Route::post('article/searchRelatedres', ['middleware' => 'auth',   'uses' => 'ArticlesController@searchRelatedres' ]);
Route::get('profile', ['middleware' => 'auth',   'uses' => 'ArticlesController@create' ]);
Route::get('tags/get/Json',['middleware' => 'auth', 'uses' => 'TagsController@returnJson']);

// Log Activity..............
Route::get('cms/logActivity','EventLogController@show');
Route::get('cms/reporteditor','EventLogController@reporteditor');
Route::get('reporteditorsearch','EventLogController@reporteditorsearch');
// Delete article using ajax
Route::match(['get', 'post'], 'article/delete', ['as' => 'article/delete', 'uses' => 'ArticlesController@destroy']);

Route::match(['get', 'post'], 'articlef/delete', ['as' => 'articlef/delete', 'uses' => 'ArticlesController@destroyfeaturenews']);
Route::post('custom/article/', 'ArticlesController@assignarticle');
Route::get('articlecustom/delete', 'ArticlesController@destroycustomnews');
//Publish image using ajax
Route::get('admin/article/publish','ArticlesController@publishBulk');
// Authentication routes...
Route::get('/article/authorddd/', function(){

    $option = Input::get('option');
    $input = $option;
    $authorList = DB::table('authors')->where('author_type_id',$input)->where('valid','1')->orderBy('name')->pluck('author_id','name');

    return $authorList;
});

Route::get('auth/login', ['middleware' => 'guest',   'uses' =>'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('forgot/password', 'Auth\AuthController@forgotPassword');
Route::post('forgot/password', 'Auth\AuthController@sendResetLink');
Route::get('reset/password/{id}', 'Auth\AuthController@resetPassword');
Route::post('reset/password', 'Auth\AuthController@saveNewPassword');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::match(['get', 'post'], 'article/addAuthor', ['as' => 'article/addAuthor', 'uses' => 'AuthorsController@store']);
Route::match(['get', 'post'], 'article/add-edit-author', ['as' => 'article/add-edit-author', 'uses' => 'AuthorsController@index']);
Route::match(['get', 'post'], 'columnist/edit', ['as' => 'columnist/edit', 'uses' => 'AuthorsController@edit']);
Route::match(['get', 'post'], 'guestauthor/add-edit-gustauthor', ['as' => 'guestauthor/add-edit-gustauthor', 'uses' => 'AuthorsController@gustauthor']);
Route::match(['get', 'post'], 'bwreporters/add-edit-bw-reporters', ['as' => 'bwreporters/add-edit-bw-reporters', 'uses' => 'AuthorsController@bwreporters']);
Route::match(['get', 'post'], 'author/delete', ['as' => 'author/delete', 'uses' => 'AuthorsController@destroy']);
Route::match(['get'], 'author/changestatus', ['as' => 'author/changestatus', 'uses' => 'AuthorsController@changeStatus']);
Route::resource('cms/category', 'CategoryController');
//Adds events from add-new-events to events Table
Route::match(['get', 'post'], 'article/addTag', ['middleware' => 'auth', 'uses' => 'TagsController@store']);

// Adds Images from CreateArticle to Images Table - Ajax Request
Route::match(['get', 'post'], 'article/addPhotos', ['as' => 'article/addPhotos', 'uses' => 'PhotosController@store']);
 // Delete Image from Create Article Form - Ajax Request
Route::get('photo/crop', ['middleware' => 'auth',   'uses' => 'PhotosController@cropImage']);
Route::get('photo/resize/crop', ['middleware' => 'auth','uses' => 'PhotosController@resizeCropImage']);
Route::match(['get', 'post'], 'article/delPhotos', ['as' => 'article/delPhotos', 'uses' => 'PhotosController@destroy']);
// Generates Topics from Article Description

//Feature Box Management

Route::get('album/list/{option}', ['middleware' => 'auth',   'uses' => 'AlbumController@index']);
Route::post('album/update', ['middleware' => 'auth',   'uses' => 'AlbumController@update' ]);
Route::match(['get', 'post'], 'album/upload', ['middleware' => 'auth',   'uses' => 'AlbumController@uploadImg']);

Route::match(['get', 'post'], '/album/delete', ['as' => '/album/delete', 'uses' => 'AlbumController@destroy']);
Route::match(['get', 'post'], '/album/publish', ['as' => '/album/publish', 'uses' => 'AlbumController@publishBulk']);

Route::post('album/image/upload', ['middleware' => 'auth',   'uses' => 'AlbumController@imageUpload' ]);
Route::get('album/image/upload',['middleware' => 'auth',   'uses' => 'AlbumController@imageUpload' ]);
Route::post('album/sort/{id}','AlbumController@sortImage');

// Roles management
Route::get('roles/manage',['middleware' => 'auth','uses' => 'RightsController@manageRole']);
Route::get('roles/add', ['middleware' => 'auth',   'uses' => 'RightsController@addRole']);
Route::get('roles/edit/{id}', ['middleware' => 'auth',   'uses' => 'RightsController@editRole']);
Route::post('roles/store', ['middleware' => 'auth',   'uses' => 'RightsController@storeRole']);
Route::post('roles/update', ['middleware' => 'auth',   'uses' => 'RightsController@updateRole']);
Route::match(['get', 'post'], 'roles/delete', ['as' => 'roles/delete', 'uses' => 'RightsController@destroyRole']);
Route::get('roles/get/channel/permission',['middleware' => 'auth','uses' => 'RightsController@getRoleChannelPermission']);
/* Newsletter start here*/
Route::resource('newsletterh','NewsletterhController',['only'=>['index','create','store','edit','update']]);
// Route::get('newsletterh/new/create','NewsletterhController@newcreate');
Route::get('newsletter/create', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@create']);
Route::get('newsletter/manage/{id}',['middleware' => 'auth',   'uses' => 'MasternewsletterController@show']);
Route::post('newsletter/searchidresult/{id}',['middleware' => 'auth',   'uses' => 'MasternewsletterController@searchIdResult']);
Route::get('cms/newsletter', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@index']);
Route::post('newsletter', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@store' ]);
Route::post('newsletter/update', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@update' ]);
Route::post('newsletter/assign', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@assign' ]);
Route::post('newsletter/sort/{id}', ['middleware' => 'auth',   'uses' => 'MasternewsletterController@sortNewsletter' ]);
Route::match(['get', 'post'], 'newsletter/delete', ['middleware' => 'auth', 'uses' => 'MasternewsletterController@destroy']);
Route::match(['get', 'post'], 'newsletter/deletens', ['middleware' => 'auth', 'uses' => 'MasternewsletterController@destroyNewsletter']);
Route::match(['get'], 'newsletter/subscriber', ['middleware' => 'auth', 'uses' => 'NewsletterSubscriberController@index']);
Route::match(['get'], 'newsletter/subscriber/exportCsv', ['middleware' => 'auth', 'uses' => 'NewsletterSubscriberController@exportCsv']);
/* Newsletter end here*/
Route::post('newsletter/sendmailer','MasternewsletterController@sendmailer');
/*menu*/

Route::post('menu/sort/{id}', 'MenuController@sortMenu');
Route::post('menu/updatestatus', 'MenuController@updatestatus');
Route::match(['get', 'post'], '/video/delete', ['as' => '/video/delete', 'uses' => 'VideoController@destroy']);
/*banner*/

Route::resource('cms/manageAds', 'BannerController');
Route::resource('/createevents', 'CreateventController');
Route::resource('mailer', 'MailerController');
/*Video routs start here */

Route::get('video/list', ['middleware' => 'auth',   'uses' => 'VideoController@index']);
Route::post('video/update', ['middleware' => 'auth',   'uses' => 'VideoController@update' ]);
Route::match(['get', 'post'], 'video/upload', ['middleware' => 'auth',   'uses' => 'VideoController@uploadImg']);
Route::post('video','VideoController@store');
Route::match(['get', 'post'], '/video/publish', ['as' => '/video/publish', 'uses' => 'VideoController@publishBulk']);
Route::get('video/{id}','VideoController@show');
Route::post('video/image/upload', ['middleware' => 'auth',   'uses' => 'VideoController@imageUpload' ]);
Route::get('video/image/upload','VideoController@imageUpload');

/*Video routs end here */
/*menu*/

/*front routes*/
/*contact pages*/

Route::get('news/term&condition.html', 'Index\IndexpageController@term_page');
Route::get('news/gdpr.html', 'Index\IndexpageController@gdpr_page');
Route::get('news/cookie&policy.html', 'Index\IndexpageController@cookie_page');
Route::post('contact-info', 'Index\IndexpageController@Contactus_Submited');

/*photogaller*/
Route::get('photogallery/{title}-{id}.html', function($title,$id){
        $href = "https://www.samachar4media.com/photo/".$title.'-'.$id.".html";
        return Redirect::to($href, 301);
});

/*photogaller*/
/*articles*/
Route::paginate('news/latest/articles.html','Index\IndexpageController@Latest_Article_listing_page');
// Route::get('feature-news.html','Article\ArticleController@Feature_Article_listing_page');
// Route::get('articles/{publish_date}.html','Article\ArticleController@Interview_Article_listing_page');


// Route::get('interviews.html','Article\ArticleController@Interview_Article_listing_page');
// Route::get('guest-column.html','Article\ArticleController@guestcoloum_Article_listing_page');

// Route::get('guest-articles.html','Article\ArticleController@gueststory_Article_listing_page');

// Route::get('interviews.html','Article\ArticleController@Interview_Article_listing_page');
Route::get('count/mostread','Article\ArticleController@countmostread');
Route::get('counttags','Article\ArticleController@counttags');
// Route::get('editor-picks.html','Article\ArticleController@Editor_Article_listing_page')->where('section', '(.*)');
/*search*/


Route::get('/cms/{id}.html','EventLogController@priview');
/*rss*/
Route::get('rss/article/{id}','Rss\RssController@individualRss');
Route::get('rss/latestfullstory','Rss\RssController@latestFullStoryRss');
Route::get('rss/facebookinstantarticles','Rss\RssController@facebookinstantarticles');
Route::get('rss/facebookinstantarticlesnew','Rss\RssController@facebookinstantarticlesnew');
Route::get('rss/category/{id}','Rss\RssController@categoryLatestRss');
Route::get('rss/years/{year}','Rss\RssController@perYearRss');
Route::get('rss/months/{month}','Rss\RssController@permonthRss');
Route::get('rss/google-news-sitemap','Rss\RssController@google_news_sitemap');
Route::get('rss/category-news-sitemap','Rss\RssController@category_news_sitemap');
Route::get('rss/sitemap-date/{cdate}','Rss\RssController@sitemap_date');
Route::get('rss/all-sitemap.xml','Rss\RssController@alldatesite');
Route::get('rss/happening','Rss\RssController@happening');
/*rss*/
// upload pdf/video files on cms
Route::resource('article/upload/files','FilesController')->middleware('auth');
Route::post('article/upload/video/files','FilesController@videostore')->middleware('auth');
Route::get('article/delete/files/{name}/{id}','FilesController@filesdestroy')->middleware('auth');

// upload pdf/video files on cms
Route::get('cache/clear', function(){
     $exitCode = Artisan::call('cache:clear');
});
Route::get('create_photojson','Photogallery\PhotogalleryController@create_photojson');

Route::get('/logsdelete', function() {
    $exitCode = Artisan::call('logs:clear');
});
Route::get('cachealbum', function(){
     $newcode = Cache::forget('sharealbum');
});
Route::get('route/clear', function(){
     $newcode = Artisan::call('route:clear');
});
Route::get('logs/clear', function(){
     $newcode = Artisan::call('logs:clear');
});