<?php
/* If you change store_location, awsbaseurl should be changed accordingaly */
return [
'store_location' =>'local',     
'articleimagedir' => 'uploads/article/',
'articleimagethambtdir' => 'uploads/article/articlethamb/',
'awarticleimagednldir' => 'uploads/article/articlednlimage/',
'articleimagemediumdir' => 'uploads/article/articlemediumimage/',
'articleimagelargedir' => 'uploads/article/articlelargeimage/',
'articleimageextralargedir' => 'uploads/article/articleextralargeimage/',
'quickbytesimageextralargedir' => 'uploads/quickbyte/quickbytesextralargeimage/',
'quickbytesimagemediumdir' =>'uploads/quickbyte/quickbytesmediumimage/',
'quickbytesimagethambtdir' => 'uploads/quickbyte/quickbytesthamb/',
'quickbyteimagedir' => 'uploads/quickbyte/',
'sponsored_image_dir' => 'uploads/sponsored/',
'sponsored_image_thumb_dir' => 'uploads/sponsored/sponsored_thumb/',
'sponsored_image_extralarge_dir' => 'uploads/sponsored/sponsored_extra_large/',     
'albumimagedir' => 'uploads/album/', 
'awarticleimagedir' => 'article/',
'awarticleimagethumbtdir' => 'files/article_thumb/',
'awarticleimagednldir' => 'article/article_dnl_image/',
'awarticleimagemediumdir' => 'article/article_medium_image/',
'awarticleimagelargedir' => 'article/article_large_image/',
'awarticleimageextralargedir' => 'files/',
'awquickbyteimagedir' => 'quickbyte/',  
'awquickbytesimagethumbtdir' => 'quickbyte/quickbytes_thumb/',
'awquickbytesimagemediumdir' =>'quickbyte/quickbytes_medium_image/',
'awquickbytesimageextralargedir' => 'quickbyte/quickbytes_extralarge_image/',
'aw_sponsored_image_dir' => 'sponsored/',  
'aw_sponsored_image_thumb_dir' => 'sponsored/sponsored_thumb/',
'aw_sponsored_image_extralarge_dir' => 'sponsored/sponsored_extralarge_image/',
'awpayslipdir' => 'payslip/', 
'awalbumimagedir' => 'album/', 
'awauthordir'=> 'album/', 
'awaevent'=> 'event/',
'awatipstag'=> 'tipstag/',
'awfeaturebox'=>'featurebox/', 
'awfeaturebox2'=>'featurebox2/', 
'awfeaturebox3'=>'featurebox3/',  
'awmagazinedir'=> 'magazineissue/',
'awspeakerdir'=> 'speaker/',
'quotesimage'=>'quotesimage/',    
'awvideo'=>'videomaster/', 
'awvideothumb'=> 'mastervideothumb/',
'awvideothumb_small'=> 'mastervideothumb/thumb/',    
'awsstaticimage'=> 'static/images/',
'debatefeatured'=>'debate/featuredimage/',
'debateexpert'=>'debate/expertimage/',     
'awbucket'=>'samachar4media',
'awsbaseurl_backup'=>'https://uat.cms.samachar4media.com/files/',
'SiteCmsurl'=>'https://storage.googleapis.com/test-media-files/',
'SiteBaseurl'=>'https://uat.site.samachar4media.com/',  
'Sitecrmurl'=>'https://uat.cms.samachar4media.com/', 
'UploadImg'=>'https://uat.site.samachar4media.com/files/',
'EditorImg'=>'https://uat.site.samachar4media.com/cms/kcfinder/upload/images/',
'PDFfilespath'=>'https://uat.site.samachar4media.com/files/pdf/',
'Videofilespath'=>'https://uat.site.samachar4media.com/files/video/',
'storagepath'=>'https://storage.googleapis.com/test-media-files/',
'awsbaseurl'=>'https://storage.googleapis.com/test-media-files/',
'recordperpage' => '20',
'maxfilesize'=>'40',
'maxfilesizevideo'=>'200',
'filesizein'=>'KB',
'dimension_article'=>'870X470',
'dimension_qb'=>'870X470',
'dimension_spost'=>'870X470',
'dimension_featurebox'=>'870X400',
'dimension_author'=>'150X105',
'dimension_event'=>'350X290',
'dimension_album'=>'680X370',
'dimension_debate'=>'870X400', 
'dimension_debate_expert'=>'126X95', 
'dimension_magz'=>'328X450',
'dimension_video'=>'680X370',
'ee_rating_cateogy_id'=>'47025',
'sitename'=>'S4M',
'JSON_FILE'=> $_SERVER['DOCUMENT_ROOT'] . '/jsonfile/homepage.json',  
'AwsBucket'=>'samachar4media',
    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Json File
    |--------------------------------------------------------------------------
    |
    | Here Indicate Json file Dir
    |
    */
    'JSON_FILE'=> $_SERVER['DOCUMENT_ROOT'] . '/jsonfile/homepage.json',
     'JSON_PHOTO'=> $_SERVER['DOCUMENT_ROOT'] . '/jsonfile/photopage.json',

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Article Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Article Image  Dir
    |
    */
   /* 
    'ARTICLE_IMAGE_DIR' => 'article/',
    'ARTICLE_IMAGE_THUMB_DIR' => 'article/article_thumb/',
    'ARTICLE_IMAGE_MEDIUM_DIR' => 'article/article_medium_image/',
    'ARTICLE_IMAGE_LARGE_DIR' => 'article/article_large_image/',*/
    'ARTICLE-IMAGE_EXTRA_LARGE_DIR' => 'files/',

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Album Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Album Image  Dir (Means PhotoShoot)
    |
    */

    'ALBUM_IMAGE_DIR' => 'album/',

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Author Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Author Image  Dir 
    |
    */
 
    'AUTHOR_DIR'=> 'album/', 

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Event Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Event Image  Dir 
    |
    */

    'EVENT_DIR'=> 'event/',   

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Magazine Issue Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Magazine Image  Dir 
    |
    */

    'MAGAZINE_DIR'=> 'magazineissue/',


    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Video master  Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Video Image , Video Dir (Means Tv Sections )
    |
    */

    'VIDEO_DIR'=>'videomaster/', 
    'VIDEO_THUMB_DIR'=> 'mastervideothumb/',
    'VIDEO_THUMB_SMALL_DIR'=> 'mastervideothumb/thumb/',

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Static Image file
    |--------------------------------------------------------------------------
    |
    | Here Indicate Static All Js ,Css And Some image Like Logo Etc
    |
    */
    
    'STATIC_IMAGE_DIR'=> 'static/images/',  


    /*
    |--------------------------------------------------------------------------
    | User Defined Variables For Static Company Details And Address
    |--------------------------------------------------------------------------
    |
    | Here Indicate Static Company Details And Address
    |
    */

    'COMPANY_NAME' => env('COMPANY_NAME','S4M'),
    'COMPANY_CONTACT_NO' => env('COMPANY_CONTACT_NO','7531820965'),
    'COMPANY_EMAIL' => env('COMPANY_EMAIL','contact@e4m.com'),
];
?>
