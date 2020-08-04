@extends('partials.app')
@section('content')
<!--main div start here-->
@if(isset($articles))
<!--middle-body-->
<div class="container mt-65 mb-4 mob-mt-75">
<!--Breaking News-->
  @if(isset($breaking))
  <div class="row m-lg-0">
    <div class="breaking_news">
      <div class="label ripple">{{strtoupper($breaking->news_label)}}</div>
      <div class="news_title">
        <marquee>
        <strong>
          
            @if($breaking->news_url == '#' || $breaking->news_url == '' || $breaking->news_url == null)
            
              {{$breaking->news_title}}
            
            @else
            <a href="{{$breaking->news_url}}" target="_blank">
              {{$breaking->news_title}}
            </a>
            @endif
          
        </strong>
      </marquee>
      </div>
    </div>  
  </div>
  @endif
  <!--Breaking News-->
<!--center-part-->
    <div class="row mob-p-0 mob-m-0">
    <!--left-part-->
        <div class="col-md-7 col-lg-9 dashed-bdr-r mob-p-0 mob-bdr-0 pl-md-0 pl-lg-3">
            @foreach($articles as $article)
            <nav aria-label="breadcrumb" class="scroll-bread-crumb mob-mt-15">
                <small>
                    <ol class="breadcrumb bg-white text-warning p-0">
                        <li class="breadcrumb-item"><a href="{{url('')}}">होम</a></li>
                        @php $a = explode('/',Request::path()); @endphp
                        @for($p=0;$p < 1 ; $p++)
                        <li class="breadcrumb-item"><a href="{{url('')}}/{{ $a[$p] }}.html">{{ $article->category_hname }}</a></li>
                        @endfor
                        
                        <li class="breadcrumb-item active">{{$article->title}}</li>
                    </ol>
                </small>
            </nav>
            @if(isset($parents[4]))  
                  @if($parents[4]->status==1)
                  {!!$parents[4]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif    
            <h1 class="story-page-hed mt-2 red-bdr-l">{{$article->title}}
                @if($article->descriptionads != '0' )
                <input type="hidden" name="desc" class="desc" value="{{ $article->descriptionads }}">
                @else
                <input type="hidden" name="desc" class="desc" value="{{ $article->description }}">
                @endif
                <a class="views" href="{{$article->url}}" ></a>
                <input type="hidden" name="title" class="title" value="{{ $article->title }}">
                <input type="hidden" name="img" class="imgc" value="{{Config::get('constants.storagepath')}}{{$article->photopath }}" onerror="this.onerror=null;this.src='https://storage.googleapis.com/media-news/default-img.jpg';"> 
            </h1>
            <p class="pl-2 pr-2"><strong>{{$article->summary}}</strong></p>
            <div class="row mt-2">
                <div class="col-lg-6 col-md-6 col-7 pr-0 s4m-staff">
                    <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">
                         <img src="{{Config::get('constants.storagepath')}}album/{{$article->photo}}" class="float-left" onerror="this.onerror=null;this.src='{{url("images/s4m-staff.png")}}';" >
                        
                    </a>
                    <span class="float-left staff-text">
                    <small>by 
                         <span>
                            <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">
                                <strong class="author-name">@if($article->authorname != 'Samachar4media Bureau' || !isset($article->authorname)){{$article->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</strong>
                            </a>
                        </span> <br>     
                        <strong class="author-name">Published</strong> -  
                        {{date("l, d F, Y", strtotime($article->publish_date))}}
                        
                    </small>
                    </span>
                    
                </div>
                <div class="col-lg-6 col-md-6 col-5 text-right pl-0 float-right mob-m-0 mt-2 mob-line-height"> 
                            <small class="date m-0">
                                <span class="text-warning">Last Modified:</span> <br>
                                <em>{{date("l, d F, Y", strtotime($article->publish_date))}}</em>
                            </small>
                        </div>
                
            </div>
            <div class="row">
                <div class="col-12 mob-p-0">
                    <img class="img-thumbnail img-fluid mt-2 mob-bdr-0" src="{{Config::get('constants.storagepath')}}{{$article->photopath}}" width="100%" alt="{{$article->phototitle}}"  title="{{$article->phototitle}}"  onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">

                </div>
            </div>
            <!-- <div class="col pl-0 text-danger">
                <small>
                    @if($article->authorname == '' || $article->authorname == null)
                    <strong>समाचार4मीडिया ब्यूरो ।।</strong>
                    @else
                    <strong>@if($article->authorname != 'Admin'){{$article->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</strong>
                    @endif
                </small>
            </div> -->
            <div class="row">
                <div class="col-md-12 share-icon">
                    <ul>
                    <li class="border-0">Share</li>
                        <li><a class="common-share facebook" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-facebook-f "></i></a></li>
                        <li><a class="common-share twitter" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="common-share linkedin" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a class="common-share whatsup" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a class="common-share mail" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fas fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>        
            <div class="row mt-2">
                <div class="col-md-12 responsible">

                    @if($article->descriptionads != '0')

                    {!! html_entity_decode($article->descriptionads,ENT_COMPAT, 'UTF-8') !!}
                   
                    @else
                    {!! html_entity_decode($article->description,ENT_COMPAT, 'UTF-8') !!}
                    
                    @endif
                    
                </div>
            </div>        
            <div class="row">
                <div class="col-md-12 tags-buttons">
                    <span class="tags"><i class="fas fa-tags"></i> TAGS </span>
                    @if(isset($article->tags) || !empty($article->tags))
                        @foreach(explode(',', $article->tags) as $tag)
                        @php $regex = '/[^\x00-\x7F]/'; @endphp
                        @if(preg_match($regex,$tag))
                            <a class="btn-sm btn m-0 pl-2 pr-2 pt-1 pb-1 custom-tags" href="{{url('tags').'/'.str_replace(' ','-',trim($tag))}}">{{$tag}}</a> 
                            
                        @else                            
                        @endif    
                        @endforeach
                    @else
                        <a class="btn-sm btn  m-0 pl-2 pr-2 pt-1 pb-1 custom-tags" href="{{url('/').'/'.$article->category_name.'-news.html'}}">{{$article->category_name}}</a>
                    @endif
                </div>
            </div>
        <div class="row mt-3">
            <div class="col-lg-8 col-md-6 col-12 share-buttons">            
                <!--Facebook-->
                <button type="button" class="btn btn-fb pl-2 pr-2 pt-1 pb-1 mr-0 ml-0 common-share facebook" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-facebook-f pr-1"></i> Share</button>
                <!--Twitter-->
                <button type="button" class="btn btn-tw pl-2 pr-2 pt-1 pb-1 mr-0 btn-info common-share twitter" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-twitter pr-1"></i> Share</button>
                <!--linkedin-->
                <button type="button" class="btn btn-li pl-2 pr-2 pt-1 pb-1 mr-0 common-share linkedin" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-linkedin-in pr-1"></i> Share</button>
                <!--whatsup-->
                <button type="button" class="btn btn-slack pl-2 pr-2 pt-1 pb-1 mr-0 common-share whatsup" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fab fa-whatsapp pr-1"></i> Share</button>
                            <!--mail-->
                <button type="button" class="btn btn-email pl-2 pr-2 pt-1 pb-1 mr-0 common-share mail" id="{{$article->url}}" data-title="{{$article->title}}"><i class="fas fa-envelope pr-1"></i> Share</button>
                <!--Github-->
            </div>
            <div class="col-lg-4 col-md-6 col-9 m-auto text-center mob-mt-30">
               <a href="https://wb.messengerpeople.com/?widget_hash=bac86292cde7a4444b6fbc935e586d7d&lang=en&wn=2&pre=1"><img src="{{asset('images/whatsapp2.png')}}" class="img-fluid whatsup rounded"></a> 
            </div>
        </div>
        <!--सब्सक्राइब-->
    <form name="form1" method="post" class="text-center" id="subform" >
    {{csrf_field()}}
        <div class="row bg-dark ml-0 mr-0 mt-3 mb-3 p-3 rounded">
            <div class="col-md-6 col-lg-6 col-12 pl-0">
        <h5 class="p-0 m-0 mob-text-center text-white mt-2 mob-mb-15"><strong>न्यूजलेटर पाने के लिए यहां सब्सक्राइब कीजिए</strong></h5>
                </div>
            
            <div class="col-md-6 col-lg-6 col-12 bg-light p-1 rounded">

<div class="input-group">
 <input type="email" name="email" id="inner_email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control bg-transparent border-0 p-1 " style="box-shadow: none;" placeholder="Email ID">

   <button type="button" class="btn btn-danger m-0 rounded waves-effect waves-light btn-md" onclick="inner_story_subcribe_form()" type="button">SUBSCRIBE</button>

</div>
                </div>
                <div class="col-md-10 col-lg-10"><div id="inner_semail_err" style="float: right;color: #fff"></div></div>
            
        </div>
</form>         
         <!--सब्सक्राइब-->       
        <hr class="dashed-bdr-t mb-1">
<!--         <div class="row mt-3 m-0 author">
            <div class="col-lg-2 col-md-4 col-4 text-center border-dark bdr-solid-r pl-0 mob-bdr-0 mob-m-auto mob-p-0">
            <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">   
            <img class="img-fluid img-thumbnail rounded-circle bg-warning mob-mt-8 mob-mb-8" src="{{Config::get('constants.storagepath')}}{{$article->photo}}" width="100%"  onerror="this.onerror=null;this.src='{{asset("images/blank.jpg")}}';">
            <h6>{{$article->authorname}}</h6>         
            </a>     
            </div>
            <div class="col-lg-10 pt-2" style="background: #f1f1f1;">
                <h5 class="mb-0"><strong>समाचार4मीडिया ब्यूरो</strong></h5>
                <p class="mb-0 mt-1">
                    <small><i class="fas fa-envelope text-muted"></i> 
                        <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">{{$article->email}}</a>
                    </small>
                </p>
                <p class="mt-0 mb-1">
                    <small><i class="fab fa-twitter text-muted"s></i> 
                        <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">{{$article->twitter}}</a>
                    </small>
                </p>
                <p class="mt-0 mb-1">
                    <small>
                        <i class="fab fa-facebook-f text-muted"></i> 
                        <a href="{{url('author').'/'.str_slug($article->authorname).'-'.$article->author_id}}">{{$article->facebook}}</a>
                    </small>
                </p>
                <p class="quotation mt-0 mb-0 text-center"> 
                    <small>{{$article->bio}}</small>
                </p>
            </div>            
        </div> -->
        <div id="disqus_thread"></div>
        <div class="row m-0 mob-mt-15">
            <span class="heading-bdr pt-5 ml-0"></span>
        </div>
        <div class="row mt-3 mb-2">
            @if(isset($parents[6]))  
                  @if($parents[6]->status==1)
                  {!!$parents[6]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif 
        
        </div>
    @endforeach
@endif   
    <!--second news-->
    @if(isset($articlesrelate))    
        @foreach($articlesrelate as $aR)
            <div class="row">
                <div class="col-md-12">     
                    <h2 class="story-page-hed mt-4 red-bdr-l">{{$aR->title}}
                        
                        @if($aR->descriptionads != '0' )
                <input type="hidden" name="desc" class="desc" value="{{ $aR->descriptionads }}">
                @else
                <input type="hidden" name="desc" class="desc" value="{{ $aR->description }}">
                @endif
                @php $url = $aR->url; $xy = explode('/',$url);
                $yz = end($xy);
                $zx = explode (".", $yz);
                $vx = current($zx);
                $vy = explode ("-", $vx);
                $sliced = array_slice($vy, 0, -1); 
                $string = ucwords(implode(" ", $sliced));            
                @endphp         
                        <a class="views" href="{{$aR->url}}" ></a>
                        <input type="hidden" name="title" class="title" value="{{ $aR->title.' | '. $string }}">
                        <input type="hidden" name="img" class="imgc" value="{{Config::get('constants.storagepath')}}{{$aR->photopath }}" onerror="this.onerror=null;this.src='https://storage.googleapis.com/media-news/default-img.jpg';"> 
                    </h2>
                    <p class="pl-2 pr-2"><strong>{{$aR->summary}}</strong></p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-7 pr-0 s4m-staff">
                            <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}">
                         <img src="{{Config::get('constants.storagepath')}}album/{{$aR->photo}}" class="float-left" onerror="this.onerror=null;this.src='{{url("images/s4m-staff.png")}}';" >
                        
                    </a>
                    <span class="float-left staff-text">
                    <small>by 
                         <span>
                            <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}">
                                <strong class="author-name">@if($article->authorname != 'Samachar4media Bureau' || !isset($article->authorname)){{$aR->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</strong>
                            </a>
                        </span> <br>     
                        <strong class="author-name">Published</strong> -  
                        {{date("l, d F, Y", strtotime($aR->publish_date))}}
                        
                    </small>
                    </span>
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-5 text-right pl-0 float-right mob-m-0 mt-2 mob-line-height"> 
                            <small class="date m-0">
                                <span class="text-warning">Last Modified:</span> <br>
                                <em>{{date("l, d F, Y", strtotime($aR->publish_date))}}</em>
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mob-p-0">
                            <img class="img-thumbnail img-fluid mt-2 mob-bdr-0" src="{{Config::get('constants.storagepath')}}{{$aR->photopath}}" width="100%" alt="{{$aR->phototitle}}" title="{{$aR->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">
                           
                        </div>
                    </div>
                    <!-- <div class="col pl-0 text-danger">
                        <small>
                            @if($aR->authorname == '' || $aR->authorname == null)
                            <strong>समाचार4मीडिया ब्यूरो ।।</strong>
                            @else
                            <strong>@if($article->authorname != 'Admin'){{$article->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</strong>
                            @endif
                            
                        </small>
                    </div>  -->          
                    <div class="row">
                        <div class="col-md-12 share-icon">
                            <ul>
                                <li class="border-0">Share</li>
                                <li><a class="common-share facebook" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-facebook-f "></i></a></li>
                                <li><a class="common-share twitter" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="common-share linkedin" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a class="common-share whatsup" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a class="common-share mail" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fas fa-envelope"></i></a></li>
                            </ul>
                        </div>
                    </div>                            
                    <div class="row mt-2">
                        <div class="col-md-12 responsible">
                         @if($aR->descriptionads != '0' )
                         
                        {!! html_entity_decode($aR->descriptionads,ENT_COMPAT, 'UTF-8') !!} 
                        @else
                        
                        {!! html_entity_decode($aR->description,ENT_COMPAT, 'UTF-8') !!} 
                        @endif   
                                               
                        </div>
                    </div>                
                    <div class="row">
                        <div class="col-md-12 tags-buttons">
                            <span class="tags"><i class="fas fa-tags"></i> TAGS</span>
                            @if(isset($aR->tags) || !empty($aR->tags))
                                @foreach(explode(',', $aR->tags) as $tag)
                                @if(preg_match($regex,$tag))
                                    <a class="btn-sm btn m-0 pl-2 pr-2 pt-1 pb-1 custom-tags" href="{{url('tags').'/'.str_replace(' ','-',trim($tag))}}">{{$tag}}</a> 
                                    
                                @else                                    
                                @endif                                   
                                @endforeach
                            @else
                                <a class="btn-sm btn m-0 pl-2 pr-2 pt-1 pb-1 custom-tags" href="{{url('/').'/'.$aR->category_name.'-news.html'}}">{{$aR->category_name}}</a>
                            @endif
                        </div>
                    </div>                
                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-6 col-12 share-buttons">                
                            <!--Facebook-->
                            <button type="button" class="btn btn-fb pl-2 pr-2 pt-1 pb-1 mr-0 ml-0 common-share facebook" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-facebook-f pr-1"></i> Share</button>
                            <!--Twitter-->
                            <button type="button" class="btn btn-tw pl-2 pr-2 pt-1 pb-1 mr-0 btn-info common-share twitter" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-twitter pr-1"></i> Share</button>
                            <!--linkedin-->
                            <button type="button" class="btn btn-li pl-2 pr-2 pt-1 pb-1 mr-0 common-share linkedin" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-linkedin-in pr-1"></i> Share</button>
                            <!--whatsup-->
                            <button type="button" class="btn btn-slack pl-2 pr-2 pt-1 pb-1 mr-0 common-share whatsup" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fab fa-whatsapp pr-1"></i> Share</button>
                                        <!--mail-->
                            <button type="button" class="btn btn-email pl-2 pr-2 pt-1 pb-1 mr-0 common-share mail" id="{{$aR->url}}" data-title="{{$aR->title}}"><i class="fas fa-envelope pr-1"></i> Share</button>
                            <!--Github-->
                        </div>
                        <div class="col-lg-4 col-md-6 col-9 m-auto text-center mob-mt-30">
                            <a href="https://wb.messengerpeople.com/?widget_hash=bac86292cde7a4444b6fbc935e586d7d&lang=en&wn=2&pre=1"><img src="{{asset('images/whatsapp2.png')}}" class="img-fluid whatsup rounded"></a>
                        </div>
                    </div>
                    <!--सब्सक्राइब-->
                    <form name="form1" method="post" class="text-center" id="subform" >
                    {{csrf_field()}}
                    <div class="row bg-dark ml-0 mr-0 mt-3 mb-3 p-3 rounded">
                        <div class="col-md-6 col-lg-6 col-12 pl-0">
                    <h5 class="p-0 m-0 mob-text-center text-white mt-2 mob-mb-15"><strong>न्यूजलेटर पाने के लिए यहां सब्सक्राइब कीजिए</strong></h5>
                            </div>
                          
                    <!-- <div class="semail_err"></div>     -->
                        <div class="col-md-6 col-lg-6 col-12 bg-light p-1 rounded">
            <div class="input-group">
             <input type="email" name="email" id="inner_email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control bg-transparent border-0 p-1 " style="box-shadow: none;" placeholder="Email ID">

               <button type="button" class="btn btn-danger m-0 rounded waves-effect waves-light btn-md" onclick="inner_story_subcribe_form()" type="button">SUBSCRIBE</button>

            </div>
                            </div>
            <div class="col-md-10 col-lg-10"><div id="inner_semail_err" style="float: right;color: #fff"></div></div>
        </div>
    </form>
        <!--सब्सक्राइब-->                
                    <hr class="dashed-bdr-t mb-1">
<!--                     <div class="row mt-3 m-0 author">
                        <div class="col-lg-2 col-md-4 col-4 text-center border-dark bdr-solid-r pl-0 mob-bdr-0 mob-m-auto mob-p-0">
                        <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}"></a>  
                            <img class="img-fluid img-thumbnail rounded-circle bg-warning mob-mt-8 mob-mb-8" src="{{Config::get('constants.storagepath')}}{{$aR->photo}}" width="100%"  onerror="this.onerror=null;this.src='{{asset("images/blank.jpg")}}';">
                            <h6>{{$article->authorname}}</h6>   
                        </div>
                        <div class="col-lg-10 pt-2" style="background: #f1f1f1;">
                <h5 class="mb-0"><strong>समाचार4मीडिया ब्यूरो</strong></h5>
                <p class="mb-0 mt-1">
                    <small><i class="fas fa-envelope text-muted"></i> 
                        <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}">{{$aR->email}}</a>
                    </small>
                </p>
                <p class="mt-0 mb-1">
                    <small><i class="fab fa-twitter text-muted"s></i> 
                        <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}">{{$aR->twitter}}</a>
                    </small>
                </p>
                <p class="mt-0 mb-1">
                    <small><i class="fab fa-facebook-f text-muted"s></i> 
                        <a href="{{url('author').'/'.str_slug($aR->authorname).'-'.$aR->author_id}}">{{$aR->facebook}}</a>
                    </small>
                </p>
                <p class="quotation mt-0 mb-0 text-center"> 
                    <small>{{$aR->bio}}</small>
                </p>
            </div>                 
                    </div>  -->               
                </div>
            </div>
            <div class="disqus_thread ">
    <a onclick="loadDisqus($(this), '{{$aR->url}}');" style=" font-weight: bold; color: #ffffff; font-size: 14px; padding: 5px 5px;  background: #1b1b1b;
">
   आपके विचार  <i class="far fa-comments"></i>
</a>
</div>
            <div class="row m-0 mob-mt-15"><span class="heading-bdr pt-5 ml-0"></span></div>
            @if(isset($parents[5]))  
                  @if($parents[5]->status==1)
                  {!!$parents[5]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif 
        @endforeach 
    @endif
    
    <!--third news-->
    
    <!--third news-->
    <!-- <div class="row mt-4 mb-4">
        <div class="col-md-12 text-center"><img src="{{asset('images/top-banner-728x90-2.jpg')}}" class="img-fluid border"></div>
    </div> -->
    <!--third-section-news-->
    <!--Social media-section-news-->
    @if(isset($socialM))
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="row pl-0 mb-3 ml-0 title-holder">
                    <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
                        @for($a=0; $a < 1; $a++)
                        <strong>                       
                            <a href="{{url('/')}}/{{$socialM[$a]->category_name}}-news.html" title="">
                                <span class="bg-white pl-3 pr-3">{{$socialM[$a]->category_hname}}</span>
                            </a>
                        </strong>
                        <small>
                            <a href="{{url('/')}}/{{$socialM[$a]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
                                <strong>और पढ़ें</strong>
                            </a>
                        </small>
                        @endfor
                    </h5>
                </div>
                <div class="row">
                    @for($a=0; $a < 3; $a++)
                    @if($a == 0)
                    <div class="col-md-12 col-lg-4 dashed-bdr-r mob-bdr-0 mob-p-0 mob-mb-15">
                        <a href="{{$socialM[$a]->url}}">
                        <img class="img-fluid rounded mob-radius-0" src="{{Config::get('constants.storagepath')}}{{$socialM[$a]->photopath}}" alt="{{$socialM[$a]->phototitle}}" title="{{$socialM[$a]->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">
                        <h6 class="mt-2 font-heading-1 mob-p-10">
                            <strong>{{$socialM[$a]->title}}</strong>
                        </h6> 
                        </a>                
                    </div>
                    @else
                    <div class="col-md-6 col-6 col-lg-4 dashed-bdr-r">
                        <a href="{{$socialM[$a]->url}}">
                        <img class="img-fluid rounded " src="{{Config::get('constants.storagepath')}}{{$socialM[$a]->photopath}}" alt="{{$socialM[$a]->phototitle}}" title="{{$socialM[$a]->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">
                        <h6 class="mt-2 font-heading-1">
                            <strong>{{$socialM[$a]->title}}</strong>
                        </h6> 
                        </a>                  
                    </div>
                    @endif
                    @endfor                  
                </div>
                <hr class="dashed-bdr-t mob-bdr-0">        
                <div class="row mt-3 mob-mt-30">
                    @for($a=3; $a < 6; $a++) 
                    @if($a == 3)                
                    <div class="col-md-12 col-lg-4 dashed-bdr-r mob-bdr-0 mob-p-0 mob-mb-15">
                        <a href="{{$socialM[$a]->url}}">
                        <img class="img-fluid rounded mob-radius-0" src="{{Config::get('constants.storagepath')}}{{$socialM[$a]->photopath}}" alt="{{$socialM[$a]->phototitle}}" title="{{$socialM[$a]->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">
                        <h6 class="mt-2 font-heading-1 mob-p-10">
                            <strong>{{$socialM[$a]->title}}</strong>
                        </h6> 
                        </a>                
                    </div>
                    @else
                    <div class="col-md-6 col-6 col-lg-4 dashed-bdr-r">
                       <a href="{{$socialM[$a]->url}}">
                        <img class="img-fluid rounded " src="{{Config::get('constants.storagepath')}}{{$socialM[$a]->photopath}}" alt="{{$socialM[$a]->phototitle}}" title="{{$socialM[$a]->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/default-img.jpg")}}';">
                        <h6 class="mt-2 font-heading-1">
                            <strong>{{$socialM[$a]->title}}</strong>
                        </h6> 
                        </a>                  
                    </div>
                    @endif
                    @endfor                  
                </div>     
            </div>
        </div>
    @endif        
<!--third-section-news-->
</div>
<!--left-part-->

@include('partials.rightsidebar') 
        
    
        </div><!--center-part-->
        
                @if(isset($parents[7]))  
                  @if($parents[7]->status==1)
                  {!!$parents[7]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif
    
    </div>
    <!--middle-body-->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{$article->title}}",
        "description": "{{$article->summary}}",
        "keywords":"{{$article->tags}}",
        "url" : "{{Request::url()}}"
    }
</script>
<script type="application/ld+json">
   {
     "@context": "https://schema.org",
     "@type": "ImageObject",
     "name": "{{$article->title}}",
     "author": "{{$article->authorname}}",
     "datePublished": "{{$article->publish_date}}"
   }
   </script>
<script type="application/ld+json">
       [{
         "@context": "https://schema.org",
         "mainEntityOfPage":"{{Request::url()}}",
         "@type": "NewsArticle",
         "url": "{{Request::url()}}",
          "articleBody":"  {!!strip_tags(str_replace('"','',$article->descriptionads))!!}",
         "articleSection":"{{$article->name}}",
         "headline": "{{$article->title}}",
         "description":"{!!strip_tags($article->summary)!!}",
         "author": "{{$article->authorname}}",
         "datePublished": "{{$article->publish_date}}",
         "dateModified": "{{$article->publish_date}}",
         "image":{
               "@context": "https://schema.org",
               "@type": "ImageObject",
               "width": "100px",
               "height": "100px",
               "url":"{{Config::get('constants.awsbaseurl')}}{{$article->photopath}}"
             },
         "publisher":{
               "@context": "https://schema.org",
               "@type": "Organization",
               "name": "Exchange4media",
               "logo": {
                       "@context": "https://schema.org",
                       "@type": "ImageObject",
                       "width": "100px",
                       "height": "100px",
                     "url": "https://exchange4media.com/images/e4m_logo.png"
                   },
               "url":"{{url('/')}}"
             }
       }]
   </script>
  <script type="application/ld+json">
   {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList", "itemListElement":
    [{ "@type": "ListItem", "position": "1",
    "item": { "@id": " https://www.exchange4media.com/ ", "name": "Home" } }
    ,{ "@type": "ListItem", "position": "2",
    "item": { "@id": "{{url('')}}/{{str_slug($article->category_name)}}-news.html",
    "name": "{{$article->category_name}}-news"
    } }] }
</script>

@endsection           