@extends('partials.app')
@section('content')
@if (Session::has('error'))
  <script>alert('{{ Session::get("error") }}')</script>
@endif

<!--middle-body-->
<div class="container mt-65">
  <!--Breaking News-->
  @if(isset($breaking))
  <div class="row m-lg-0">
    <div class="breaking_news">
      <div class="label ripple">{{strtoupper($breaking->news_label)}}</div>
      <div class="news_title">
        <marquee onmouseover="this.stop();" onmouseout="this.start();">
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

      <div class="row m-0"><h1 class="mb-3 mt-2 top-news-hed heading-bdr-top"><span class="pl-3 pr-3"><strong>मीडिया, विज्ञापन व सोशल मीडिया की प्रमुख खबरें
</strong></span></h1></div>
      
  <!--top news section-->
  <div class="row top-news-section section-style pt-3 pb-3 m-lg-0"> 
    <div class="col-sm-12 col-md-6 col-lg-6  py-0 pl-3 pr-1 featcard">
     <div id="topslider" class="carousel slide carousel-fade" data-ride="carousel">
       <div class="carousel-inner">
        @php $rows_articlehomeslide='1'; @endphp
        @foreach($homeSlide as $keyhomeslide)
        @if($keyhomeslide->sequence=='1')
        @php $rows_articlehomeslide++; @endphp
        
        <div class="carousel-item active">   
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" ></a>            
            <div class="card-img-overlay d-flex linkfeat">
              <a href="{{$keyhomeslide->category_ename}}-news.html"><span class="badge">{{$keyhomeslide->category_hname}}</span></a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"> 
                <h2 class="card-title top-slide-text">{{$keyhomeslide->title}}</h2>                
              </a>
            </div>
          </div>
        
        </div>

        @elseif ($keyhomeslide->sequence =='2')
        @php  $rows_articlehomeslide++; @endphp
        <div class="carousel-item">       
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" ></a>
            <div class="card-img-overlay d-flex linkfeat">
              <a href="{{$keyhomeslide->category_ename}}-news.html"><span class="badge">{{$keyhomeslide->category_hname}}</span></a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"> 
                <h2 class="card-title top-slide-text">{{$keyhomeslide->title}}</h2>
              </a>
            </div>
          </div>
        </div>
        @elseif ($keyhomeslide->sequence =='3')
        @php  $rows_articlehomeslide++; @endphp
        <div class="carousel-item">       
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" ></a>
            <div class="card-img-overlay d-flex linkfeat">
              <a href="{{$keyhomeslide->category_ename}}-news.html"><span class="badge">{{$keyhomeslide->category_hname}}</span></a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"> 
                <h2 class="card-title top-slide-text">{{$keyhomeslide->title}}</h2>

              </a>
            </div>
          </div>
        </div>
        @elseif ($keyhomeslide->sequence =='4')
        @php  $rows_articlehomeslide++; @endphp
        <div class="carousel-item">       
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" ></a>
            <div class="card-img-overlay d-flex linkfeat">
              <a href="{{$keyhomeslide->category_ename}}-news.html"><span class="badge">{{$keyhomeslide->category_hname}}</span></a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"> 
                <h2 class="card-title top-slide-text">{{$keyhomeslide->title}}</h2>                    
              </a>
            </div>
          </div>
        </div>
        @elseif ($keyhomeslide->sequence =='5')
        @php  $rows_articlehomeslide++; @endphp
        <div class="carousel-item">       
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" ></a>
            <div class="card-img-overlay d-flex linkfeat">
              <a href="{{$keyhomeslide->category_ename}}-news.html"><span class="badge">{{$keyhomeslide->category_hname}}</span></a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"> 
                <h2 class="card-title top-slide-text">{{$keyhomeslide->title}}</h2>                    
              </a>
            </div>
          </div>
        </div>
        @php  $rows_articlehomeslide++; @endphp          
        @endif 
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#topslider" data-slide="prev">
        <i class="fas fa-angle-left text-white"></i>
      </a>
      <a class="carousel-control-next" href="#topslider" data-slide="next">
        <i class="fas fa-angle-right text-white"></i>
      </a>

    </div>
  </div>
  <div class="col-6 py-0 px-1 d-none d-lg-block d-md-block">
    <div class="row">
      @php $rows_articlehomeslide='1'; @endphp
      @if(count($homeSlide)>0)
      @foreach($homeSlide as $keyhomeslide)
      @if($keyhomeslide->sequence =='2')
      @php  $rows_articlehomeslide++; @endphp
      <div class="col-6 pb-2 mg-1 ml-md-2">
        <div class="card bg-dark text-white">
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story1.jpg';"></a>
          <div class="card-img-overlay d-flex top-hed">
            
              <a href="{{$keyhomeslide->category_ename}}-news.html" class="align-self-end"><span class="badge d-md-none d-lg-inline-block">{{$keyhomeslide->category_hname}}</span> </a>
             <a href="{{$keyhomeslide->url}}" class="align-self-end">
              <h3 class="card-title mb-0 top-slide-text2">{{$keyhomeslide->title}}</h3>
            </a>
          </div>
        </div>
      </div>
      @elseif($keyhomeslide->sequence =='3')
      @php $rows_articlehomeslide++; @endphp
      <div class="col-6 pb-2 mg-2 ">
        <div class="card bg-dark text-white">
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story2.jpg';"></a>
          <div class="card-img-overlay d-flex top-hed">
            
             <a href="{{$keyhomeslide->category_ename}}-news.html" class="align-self-end"> <span class="badge d-md-none d-lg-inline-block">{{$keyhomeslide->category_hname}}</span> </a>
             <a href="{{$keyhomeslide->url}}" class="align-self-end"> <h3 class="card-title mb-0 top-slide-text2">{{$keyhomeslide->title}}</h3>
            </a>
          </div>
        </div>
      </div>
      @elseif ($keyhomeslide->sequence =='4')
      @php  $rows_articlehomeslide++; @endphp
      <div class="col-6 pb-2 mg-3 ml-md-2 mt-md-2 mt-lg-0">
        <div class="card bg-dark text-white">
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story3.jpg';"></a>
          <div class="card-img-overlay d-flex top-hed">
            <a href="{{$keyhomeslide->category_ename}}-news.html" class="align-self-end">
              <span class="badge d-md-none d-lg-inline-block">{{$keyhomeslide->category_hname}}</span>  </a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"><h3 class="card-title mb-0 top-slide-text2">{{$keyhomeslide->title}}</h3>
            </a>
          </div>
        </div>
      </div>
      @elseif ($keyhomeslide->sequence =='5')
      @php  $rows_articlehomeslide++; @endphp
      <div class="col-6 pb-2 mg-4 mt-md-2 mt-lg-0">
        <div class="card bg-dark text-white">
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story4.jpg';"></a>
          <div class="card-img-overlay d-flex top-hed">
            <a href="{{$keyhomeslide->category_ename}}-news.html" class="align-self-end">
              <span class="badge d-md-none d-lg-inline-block">{{$keyhomeslide->category_hname}}</span> </a>
              <a href="{{$keyhomeslide->url}}" class="align-self-end"><h3 class="card-title mb-0 top-slide-text2">{{$keyhomeslide->title}}</h3>
            </a>
          </div>
        </div>
      </div>
      @php  $rows_articlehomeslide++; @endphp          
      @endif 
      @endforeach
      @endif
    </div>
  </div>
</div>
<!--top news section-->

<hr class="mt-4" style="border: dashed 0.5px #dee2e6;">


<!--2nd section-->
<div class="row pl-0 mb-3 mob-m-0 title-holder m-lg-0">
  <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
    @if(isset($customSection[0]))
    @for($cs=0;$cs < 1;$cs++)
    <strong>
      <a href="{{$customSection[$cs]->category_ename}}-news.html">
        <span class="bg-white pl-3 pr-3">बड़ी खबरें </span>
      </a>
    </strong>
    <small>
      <a href="{{$customSection[$cs]->category_ename}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
        
      </a>
    </small>
    @endfor
  </h5>
</div>
@endif
@if(isset($customSection))
<div class="row industry-brefing mt-lg-3 p-3 mob-mt-15 tab-mt-0 rounded mb-bg-light m-lg-0"> 
  @foreach($customSection as $cs) 
  <div class="col-md-3 mob-mb-15">
    <div class="row">
      <div class="col-6 col-sm-12 col-md-12 col-lg-6 pr-0">
        <a href="{{$cs->url}}">
          <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$cs->photopath}}" alt="{{$cs->phototitle}}" title="{{$cs->phototitle}}" onerror="this.onerror=null;this.src='images/industry-story1.jpg';">
        </a>
      </div>
      <div class="col-6 col-sm-12 col-md-12 col-lg-6 pr-0 pt-lg-0 pl-lg-2 pl-md-3 pt-md-1">
        <h6 class="mb-0">
          <a href="{{$cs->url}}">
            <strong>{{$cs->title}}</strong>
          </a>
        </h6>
         
      </div>    
    </div>  
  </div>
  @endforeach
  @endif  
</div>

<!--2nd section-->
<hr class="mt-4 mb-2" style="border: dashed 0.5px #dee2e6;">
<!--square-add-->
        <div class="row">
          @if(isset($parents[11]))  
          @if($parents[11]->status==1)
          {!!$parents[11]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      @if(isset($parents[12]))  
          @if($parents[12]->status==1)
          {!!$parents[12]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      @if(isset($parents[13]))  
          @if($parents[13]->status==1)
          {!!$parents[13]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      @if(isset($parents[14]))  
          @if($parents[14]->status==1)
          {!!$parents[14]->bscript!!}
          @else 
          @endif 
        @else
      @endif
        
        </div>
        <!--square-add-->
  
  <!--tabs story-->
  <div class="col-12 p-3 my-bg-light rounded border-light border">
    
<!-- Tab panels -->
<div class="tab-content p-0">

    <!-- Nav tabs -->
    <div class="row m-0">
      <div class="col-lg-3 col-md-3 col-12">
        <!-- <h3 class="media-hed text-center">मीडिया</h3> -->
        <ul class="nav md-pills pills-primary flex-column my-pills bdr-solid-r border-warning pt-3 pb-3 pl-0 pr-0 nav-stacked" role="tablist">
          @if(isset($print[0]->category_hname))
          <li class="nav-item active show">
            <a class="nav-link " data-toggle="tab" onclick='location.href="{{$print[0]->category_name}}-news.html"' href="#panel21" role="tab" aria-selected="false">{{ $print[0]->category_hname }}
            </a>
          </li>
          @endif
           @if(isset($tv[0]->category_hname))
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" onclick='location.href="{{$tv[0]->category_name}}-news.html"' href="#panel22" role="tab" aria-selected="false">{{ $tv[0]->category_hname }}
              
            </a>
          </li>
          @endif
           @if(isset($radio[0]->category_hname))
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" onclick='location.href="{{$radio[0]->category_name}}-news.html"' href="#panel23" role="tab" aria-selected="false">{{ $radio[0]->category_hname }}
              
            </a>
          </li>
          @endif
           @if(isset($digital[0]->category_hname))
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" onclick='location.href="{{$digital[0]->category_name}}-news.html"' href="#panel24" role="tab" aria-selected="false">{{ $digital[0]->category_hname }}
              
            </a>
          </li>
          @endif 
          @if(isset($industryBriefing[0]->category_hname))
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" onclick='location.href="{{$industryBriefing[0]->category_name}}-news.html"' href="#panel25" role="tab" aria-selected="false">{{ $industryBriefing[0]->category_hname }}
              
            </a>
          </li>
          @endif
        </ul>
      </div>
      <div class="col-lg-9 col-md-9 col-12 mob-p-0">
        <!-- Tab panels -->
        <div class="tab-content vertical p-0">
        @if(isset($print))
          <!-- Panel 1 -->
          <div class="tab-pane fade in active show" id="panel21" role="tabpanel">
            <a href="#panel21"  role="tab" data-toggle="tab">
           <div class="col-lg-12 col-md-12 text-left pt-0 mob-p-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">{{ $print[0]->category_hname }}</span>
</strong><small><a href="{{$print[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
      
      <div class="row m-0">
     @for($prt=0;$prt < 2;$prt++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $print[$prt]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$print[$prt]->photopath}}" alt="{{ $print[$prt]->phototitle }}" title="{{ $print[$prt]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $print[$prt]->url }}"><strong>{!! $print[$prt]->title !!}</strong></a> 
     
    </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
 
        </div>
       
        
         <p class="m-5 mob-dspl-none"></p>
       
         <div class="row m-0">
       @for($prt=2;$prt < 4;$prt++)   
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $print[$prt]->url }}"><img src="{{Config::get('constants.newstorage')}}{{$print[$prt]->photopath}}" alt="{{ $print[$prt]->phototitle }}" title="{{ $print[$prt]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $print[$prt]->url }}"><strong>{!! $print[$prt]->title !!}</strong></a> 
      
    </h6>   
    </div>    
    </div>
    
        </div>
      @endfor         
        </div>
       
      </div>
    </a>
          </div>
          <!-- Panel 1 -->
      @endif
      @if(isset($tv))
          <!-- Panel 2 -->
          <div class="tab-pane fade" id="panel22" role="tabpanel">
            <a href="#panel22"  role="tab" data-toggle="tab">
           <div class="col-lg-12 col-md-12 text-left pt-0 mob-p-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">{{ $tv[0]->category_hname }} </span>
</strong><small><a href="{{$tv[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
        
      <div class="row m-0">
        
        @for($tvl=0;$tvl < 2;$tvl++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $tv[$tvl]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$tv[$tvl]->photopath}}" alt="{{ $tv[$tvl]->phototitle }}" title="{{ $tv[$tvl]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $tv[$tvl]->url }}"><strong>{!! $tv[$tvl]->title !!}</strong></a> 
      
    </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
  
        </div>
        
         <p class="m-5 mob-dspl-none"></p>
         
         <div class="row m-0">
        
        @for($tvl=2;$tvl < 4;$tvl++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $tv[$tvl]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$tv[$tvl]->photopath}}" alt="{{ $tv[$tvl]->phototitle }}" title="{{ $tv[$tvl]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $tv[$tvl]->url }}"><strong>{!! $tv[$tvl]->title !!}</strong></a>
     
   </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
 
        </div>
        
      </div>
    </a>
          </div>
          <!-- Panel 2 -->
      @endif
      @if(isset($radio))
          <!-- Panel 3 -->
          <div class="tab-pane fade" id="panel23" role="tabpanel">
            <a href="#panel23"  role="tab" data-toggle="tab">
            <div class="col-lg-12 col-md-12 text-left pt-0 mob-p-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">{{ $radio[0]->category_hname }}  </span>
</strong><small><a href="{{$radio[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
        
      <div class="row m-0">
        
        @for($rd=0;$rd < 2;$rd++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $radio[$rd]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$radio[$rd]->photopath}}" alt="{{ $radio[$rd]->phototitle }}" title="{{ $radio[$rd]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $radio[$rd]->url }}"><strong>{!! $radio[$rd]->title !!}</strong></a>
     
   </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
        
        </div>
        
         <p class="m-5 mob-dspl-none"></p>
         
         <div class="row m-0">
        
        @for($rd=2;$rd < 4;$rd++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $radio[$rd]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$radio[$rd]->photopath}}" alt="{{ $radio[$rd]->phototitle }}" title="{{ $radio[$rd]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $radio[$rd]->url }}"><strong>{!! $radio[$rd]->title !!}</strong></a>
     
   </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
       
        </div>
        
      </div>
    </a>
          </div>
          <!-- Panel 3 -->
      @endif
      @if(isset($digital))
      
         <!-- Panel 4 -->
          <div class="tab-pane fade" id="panel24" role="tabpanel">
            <a href="#panel24"  role="tab" data-toggle="tab">
            <div class="col-lg-12 col-md-12 text-left pt-0 mob-p-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">{{ $digital[0]->category_hname }} </span>
</strong><small><a href="{{$digital[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
        
      <div class="row m-0">
        
         @for($digi=0;$digi < 2;$digi++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $digital[$digi]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$digital[$digi]->photopath}}" alt="{{ $digital[$digi]->phototitle }}" title="{{ $digital[$digi]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $digital[$digi]->url }}"><strong>{!! $digital[$digi]->title !!}</strong></a>
     
   </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
        </div>
        
         <p class="m-5 mob-dspl-none"></p>
         
         <div class="row m-0">
        
        @for($digi=2;$digi < 4;$digi++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $digital[$digi]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$digital[$digi]->photopath}}" alt="{{ $digital[$digi]->phototitle }}" title="{{ $digital[$digi]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $digital[$digi]->url }}"><strong>{!! $digital[$digi]->title !!}</strong></a> 
     
    </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
        
        
        </div>
        
      </div>
    </a>
          </div>
          <!-- Panel 4 -->
      @endif
      @if(isset($industryBriefing))
      
         <!-- Panel 5 -->
          <div class="tab-pane fade" id="panel25" role="tabpanel">
            <a href="#panel25"  role="tab" data-toggle="tab">
            <div class="col-lg-12 col-md-12 text-left pt-0 mob-p-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">{{ $industryBriefing[0]->category_hname }} </span>
</strong><small><a href="{{$industryBriefing[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
        
      <div class="row m-0">
        
         @for($iB=0;$iB < 2;$iB++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $industryBriefing[$iB]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$industryBriefing[$iB]->photopath}}" alt="{{ $industryBriefing[$iB]->phototitle }}" title="{{ $industryBriefing[$iB]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $industryBriefing[$iB]->url }}"><strong>{!! $industryBriefing[$iB]->title !!}</strong></a>
     
   </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
        </div>
        
         <p class="m-5 mob-dspl-none"></p>
         
         <div class="row m-0">
        
        @for($iB=2;$iB < 4;$iB++)     
        <div class="col-md-6 mob-p-10"> 
          
          <div class="row mt-1">
    <div class="col-4 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="{{ $industryBriefing[$iB]->url }}"><img data-src="{{Config::get('constants.newstorage')}}{{$industryBriefing[$iB]->photopath}}" alt="{{ $industryBriefing[$iB]->phototitle }}" title="{{ $industryBriefing[$iB]->phototitle }}" class="img-fluid img-thumbnail"></a></div>
    <div class="col-8 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="{{ $industryBriefing[$iB]->url }}"><strong>{!! $industryBriefing[$iB]->title !!}</strong></a> 
     
    </h6>   
    </div>    
    </div>
          
        </div>
         @endfor 
        
        
        
        </div>
        
      </div>
    </a>
          </div>
          <!-- Panel 5 -->
      @endif
      
         <!-- Panel 5 -->
          <!-- <div class="tab-pane fade " id="panel25" role="tabpanel">
            <div class="col-lg-12 col-md-12 text-left pt-0">
        
        <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
    <h5 class="mb-0 heading-bdr"><strong><span class="my-bg-light pl-2 pr-3">विचार मंच </span>
</strong><small><a href="#" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore my-bg-light"><strong>और पढ़ें</strong></a></small></h5></div>
        
      <div class="row m-0">
        
        <div class="col-md-6"> 
          
          <div class="row mt-1">
    <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="#"><img src="images/telecop-story1.jpg" class="img-fluid img-thumbnail"></a></div>
    <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="#"><strong>इस DU में पत्रकारिता के छात्रों का विरोध प्रदर्शन, पुलिस पर लगाय</strong>ा</a> <p><small class="float-left date mt-2"><i class="far fa-calendar"></i> 19 July, 2018</small></p> </h6>   
    </div>    
    </div>
          
        </div>
        
        <div class="col-md-6"> 
          
          <div class="row mt-1">
    <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="#"><img src="images/telecop-story2.jpg" class="img-fluid img-thumbnail"></a></div>
    <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="#"><strong>इस DU में पत्रकारिता के छात्रों का विरोध प्रदर्शन, पुलिस पर लगाय</strong>ा</a> <p><small class="float-left date mt-2"><i class="far fa-calendar"></i> 19 July, 2018</small></p> </h6>   
    </div>    
    </div>
          
        </div>
        
        
        </div>
        
         <p class="m-5"></p>
         
         <div class="row m-0">
        
        <div class="col-md-6"> 
          
          <div class="row mt-1">
    <div class="col-6 col-sm-12 col-md-5     col-lg-5 pr-0"><a href="#"><img src="images/top-story2.jpg" class="img-fluid img-thumbnail"></a></div>
    <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="#"><strong>इस DU में पत्रकारिता के छात्रों का विरोध प्रदर्शन, पुलिस पर लगाय</strong>ा</a> <p><small class="float-left date mt-2"><i class="far fa-calendar"></i> 19 July, 2018</small></p> </h6>   
    </div>    
    </div>
    
        </div>
        
        <div class="col-md-6"> 
          
          <div class="row mt-1">
    <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0"><a href="#"><img src="images/top-story1.jpg" class="img-fluid img-thumbnail"></a></div>
    <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2"><h6 class="mb-0"><a href="#"><strong>इस DU में पत्रकारिता के छात्रों का विरोध प्रदर्शन, पुलिस पर लगाय</strong>ा</a> <p><small class="float-left date mt-2"><i class="far fa-calendar"></i> 19 July, 2018</small></p> </h6>   
    </div>    
    </div>
          
        </div>
        
        
        </div>
        
      </div>
          </div> -->
          <!-- Panel 5 -->
      
      
        </div>
      </div>
    </div>
    <!-- Nav tabs -->

</div>
<!-- Tab panels -->
  
    </div>
  <hr class="mt-4 mb-4" style="border: dashed 0.5px #dee2e6;"> 
  <!--tabs story-->     
<!--3rd section-->
<div class="row mt-3">
  <div class="col-lg-3 col-md-7 media-form pl-3 pr-3 dashed-bdr-r mob-bdr-0">
    <div class="row ml-0 title-holder">
      @if(isset($mediaForum))
      @for($mf=0;$mf < 1;$mf++)
      <div class="widget-title-cover">
        <h5 class="widget-title">
          <a href="{{$mediaForum[$mf]->category_name}}-news.html">
            <span>मीडिया फोरम</span>
          </a>
        </h5>
        <a href="{{$mediaForum[$mf]->category_name}}-news.html" title="और देखें" class="float-right mt-2 text-danger mob-seemore"><strong>और पढ़ें</strong>
        </a>
      </div>
      @endfor
    </div>        
    <ul>
      
      @foreach($mediaForum as $no=>$mF)
      @php $no++; @endphp
      <li>
        <span class="big-number">{{$no}}.</span>
        <a href="{{$mF->url}}">{{$mF->title}}</a> 
        
      </li>
      
      @endforeach
      @endif
    </ul>   
  </div>

  <div class="col-lg-6 col-md-12 pl-4 pr-4 dashed-bdr-r mob-p-0 mob-bdr-0">
    <div class="row mob-m-0">
      @if(isset($jobs))
      
      <div class="row pl-0 mb-3 ml-0 title-holder mob-admsn-job">
        <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
          <strong>
            <a href="{{$jobs[0]->category_name}}-news.html">
              <span class="bg-white pl-2 pr-3">एडमिशन/जॉब्स</span>
            </a>
          </strong>
          <small>
            <a href="{{$jobs[0]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
              <strong>और पढ़ें</strong>
            </a>
          </small>
        </h5>
      </div>  
      <div class="col-md-6 p-1 mob-p-0 admsn-top-stry"> 
        <a href="{{ $jobs[0]->url }}">
          <img class="img-fluid img-thumbnail border-0" data-src="{{Config::get('constants.newstorage')}}{{$jobs[0]->photopath}}" alt="{{$jobs[0]->phototitle}}" title="{{$jobs[0]->phototitle}}" onerror="this.onerror=null;this.src='images/new-1.jpg';">
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong><a href="{{ $jobs[0]->url }}">{{$jobs[0]->title}}</a></strong>
        </h6>
        <p>
          {{ $jobs[0]->summary }}

        </p>

    
        <hr>
        <div class="row mt-1 mb-2 ml-0 mr-0">
         <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0">
           <a href="{{ $jobs[1]->url }}">
             <img class="img-fluid img-thumbnail border-0" data-src="{{Config::get('constants.newstorage')}}{{$jobs[1]->photopath}}" alt="{{$jobs[1]->phototitle}}" title="{{$jobs[1]->phototitle}}" onerror="this.onerror=null;this.src='images/admision-story2.jpg';">
           </a>
         </div>
         <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2">
           <h6 class="mb-0">

               <a href="{{ $jobs[1]->url }}"><strong>{{ $jobs[1]->title }}</strong></a>
               
             
           </h6>
         </div>
       </div>
      </div>
      

      <div class="col-md-6 media-form mob-admsn-reltd">
        @for($x = 2; $x < count($jobs); $x++ )
        <div class="row mt-1">
          <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0">
            <a href="{{ $jobs[$x]->url }}">
              <img class="img-fluid img-thumbnail border-0" data-src="{{Config::get('constants.newstorage')}}{{$jobs[$x]->photopath}}" alt="{{$jobs[$x]->phototitle}}" title="{{$jobs[$x]->phototitle}}" onerror="this.onerror=null;this.src='images/admision-story2.jpg';">
            </a>
          </div>
          <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2">
            <h6 class="mb-0">
              
                <a href="{{ $jobs[$x]->url }}"><strong>{{ $jobs[$x]->title }}</strong></a>
             
            
            </h6>    
          </div>    
        </div>
        <hr>
        @endfor        
        @endif         
      </div>
    </div>
  </div>
  @if(isset($polls) && isset($poll_answer))
  <div class="col-lg-3 col-md-5 col-xs-3 col-sm-3 pl-3 pr-3 pb-0 pt-0 text-center mob-dspl-blck top-sq-bn">
    @if(isset($parents[1]))  
          @if($parents[1]->status==1)
          {!!$parents[1]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      <hr>
                  @if($poll_answer != '')
              <form method="post" id="poll_form" class="text-left border-warning border rounded bdr-solid">
              {{csrf_field()}}
              <input type="hidden" name="poll_id" id="poll_id" value="{{$polls->id}}"/>
            <div class="modal-header pl-2 pr-2 pt-1 pb-1 bg-warning text-white rounded-top">
                <h5 class="modal-title w-100" id="myModalLabel">
                  <i class="fas fa-poll mr-2 text-white"></i>
                  <strong>आपका वोट</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pl-3 pr-3 pt-1 pb-3">
          <p>
            <strong>
              @if(isset($polls->Hyperlink))
                <a href="{{$polls->Hyperlink}}">{{ $polls->question}}</a>
              @else
                {{ $polls->question}}
              @endif
            </strong>
          </p>
          <hr class="bdr-solid-b">
          <div class="scrollbar style-4 vote-h" style="height: 120px">
          @foreach($poll_answer as $key)
          <!-- Group of default radios - option 1 -->
          
          <div class="row">
            <div class="col-md-2 col-2 pt-1">
              <input type="radio" name="votes" value="{{ $key->id }}" style="width: 70%;" required="">
            </div>
            <div class="col-md-10 col-10 pl-2">
            <label>{{ $key->answer }}</label>
          </div>
          </div>
        
          <hr class="m-2">
          @endforeach 
          </div>
            <span id="ans_validation" style="color: red;"></span> 
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-dark btn-sm" onclick="pollsubmit()">
                  <strong>Vote</strong>
                </button>
                <a href="{{url('poll/result/'.$polls->id)}}" type="button" class="btn btn-dark btn-sm">
                  <strong>View Result</strong>
                </a>
            </div>
          </form>
          @endif

          </div>
          @endif
      
</div>
<!--3rd section-->  
<hr class="mt-4 mb-4" style="border: dashed 0.5px #dee2e6;">

<!--4th section-->
<div class="row mt-3">
  <div class="row ml-0 title-holder pl-3 pr-3 pb-2 mob-mb-8">
    @if(isset($mostRead))
    @for($mre=0;$mre < 1;$mre++)
    <div class="widget-title-cover yellow-hed">
      <h5 class="widget-title">
        <a>
          <span>सबसे लोकप्रिय खबरें</span>
        </a>
      </h5>
      <!-- <a href="{{$mostRead[$mre]->category_name}}-news.html" title="और देखें" class="float-right mt-2 text-danger mob-seemore">
        <strong>और पढ़ें</strong>
      </a> -->
    </div>
    @endfor
  </div>
  @foreach($mostRead as $index=>$mR)
  @if($index == 0 || $index == 3)
  <div class="col-lg-4 col-md-12 media-form dashed-bdr-r mob-p-0 mob-bdr-0">
    <div class="card bg-dark text-white">
          <a href="{{$mR->url}}">
             <img class="img-fluid img-thumbnail border-0" data-src="{{Config::get('constants.newstorage')}}{{$mR->photopath}}" alt="{{$mR->phototitle}}" title="{{$mR->phototitle}}" onerror="this.onerror=null;this.src='images/lok-news.jpg';" >
          </a>
          <div class="card-img-overlay d-flex top-hed" style="background: none">
            <a href="{{$mR->category_name}}-news.html" class="align-self-end">
              <span class="badge d-md-none d-lg-inline-block">{{$mR->category_hname}}</span> 
            </a>
              
          </div>
        </div>
     
    <h5 class="mt-2 font-heading-1">
      <strong><a href="{{$mR->url}}">{{$mR->title}}</a></strong>
    </h5>
    <p>{{$mR->summary}}
      
    </p>
  </div>
  @else
    <div class="col-lg-4 col-md-6 media-form dashed-bdr-r mob-p-0 mob-bdr-0">
    <div class="card bg-dark text-white">
          <a href="{{$mR->url}}">
             <img class="img-fluid img-thumbnail border-0" data-src="{{Config::get('constants.newstorage')}}{{$mR->photopath}}" alt="{{$mR->phototitle}}" title="{{$mR->phototitle}}" onerror="this.onerror=null;this.src='images/lok-news.jpg';">
          </a>
          <div class="card-img-overlay d-flex top-hed" style="background: none">
            <a href="{{$mR->category_name}}-news.html" class="align-self-end">
              <span class="badge d-md-none d-lg-inline-block">{{$mR->category_hname}}</span> 
            </a>
              
          </div>
        </div>
     
    <h5 class="mt-2 font-heading-1">
      <strong><a href="{{$mR->url}}">{{$mR->title}}</a></strong>
    </h5>
    <p>{{$mR->summary}}
      
    </p>
  </div>
  @endif
  @if($index == 2)
  <div class="col-12 m-0">
  <hr class="border-top bdr">
</div>
  @endif
  @endforeach
  @endif    
</div>
<!--4th section-->    
<hr class="mt-4" style="border: dashed 0.5px #dee2e6;">  
<!--5th section-->
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 m-auto red-r-bdr">
    @if(isset($interview))
    @for($i = 0; $i < 1; $i++)
    <div class="row mb-3 tab-mb-0 ml-0 title-holder">
      <h5 class="mb-0 heading-bdr" style="font-size: 25px;">
        <a href="{{url('/')}}/{{$interview[$i]->category_name}}-news.html">
          <span class="bg-white pr-3">इंटरव्यू</span>
        </a>
        <small>
          <a href="{{url('/')}}/{{$interview[$i]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और पढ़ें</strong>
          </a>
        </small>
      </h5>      
    </div>        
    <div class="row mob-bg-light-y">
      <div class="col-lg-6 col-md-12 col-sm-12 pb-2 mg-1 mob-bdr-0 tab-brd-b pb-md-3">
        <div class="card bg-dark text-white mob-bdr-solid mob-radius-0 mob-mt-15">
          <img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$interview[$i]->photopath}}" alt="{{$interview[$i]->phototitle}}" title="{{$interview[$i]->phototitle}}" onerror="this.onerror=null;this.src='images/brand-1.jpg';">
          <div class="card-img-overlay d-flex">
            <a href="{{$interview[$i]->url}}" class="align-self-end">
              
              <h6 class="card-title mb-0">{{$interview[$i]->title}}</h6>
            </a>
          </div>
        </div>
      </div>
      @endfor
      @for($i = 1; $i < count($interview); $i++)
      <div class="col-lg-6 col-md-12 col-sm-12 pb-2 mg-1 pt-md-1">
        <div class="card bg-dark text-white mob-bdr-solid mob-radius-0 mob-mt-8 mob-mb-8">
          <img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$interview[$i]->photopath}}" alt="{{$interview[$i]->phototitle}}" title="{{$interview[$i]->phototitle}}" onerror="this.onerror=null;this.src='images/brand-2.jpg';">
          <div class="card-img-overlay d-flex">
            <a href="{{$interview[$i]->url}}" class="align-self-end">
              
              <h6 class="card-title mb-0">{{$interview[$i]->title}}</h6>
            </a>
          </div>
        </div>
      </div>
      @endfor
    </div>
    @endif
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 m-auto">
    @if(isset($vicharmanch))
    @for($y = 0; $y < 1; $y++)
    <div class="row mb-3 tab-mb-0 ml-0 title-holder mob-mt-30">
      <h5 class="mb-0 heading-bdr" style="font-size: 25px;">
        <a href="{{url('/')}}/{{$vicharmanch[$y]->category_name}}-news.html">
          <span class="bg-white pr-3">विचार मंच</span>
        </a>  
        <small>
          <a href="{{url('/')}}/{{$vicharmanch[$y]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और पढ़ें</strong>
          </a>
        </small>
      </h5>      
    </div>    
    <div class="row mob-bg-light-y">      
      <div class="col-lg-6 col-md-12 col-sm-12 pb-2 mg-1 mob-bdr-0 tab-brd-b pb-md-3">
        <div class="card bg-dark text-white mob-bdr-solid mob-radius-0 mob-mt-15">
          <img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$vicharmanch[$y]->photopath}}" alt="{{$vicharmanch[$y]->phototitle}}" title="{{$vicharmanch[$y]->phototitle}}" onerror="this.onerror=null;this.src='images/new-1.jpg';">
          <div class="card-img-overlay d-flex">
            <a href="{{$vicharmanch[$y]->url}}" class="align-self-end">
              
              <h6 class="card-title mb-0">{{$vicharmanch[$y]->title}}</h6>
            </a>
          </div>
        </div>
      </div>
      @endfor
      @for($y = 1; $y < 2; $y++)
      <div class="col-lg-6 col-md-12 col-sm-12 pb-2 mg-1 pt-md-1">
        <div class="card bg-dark text-white mob-bdr-solid mob-radius-0 mob-mt-8 mob-mb-8">
          <img class="card-img img-fluid" data-src="{{Config::get('constants.newstorage')}}{{$vicharmanch[$y]->photopath}}" alt="{{$vicharmanch[$y]->phototitle}}" title="{{$vicharmanch[$y]->phototitle}}" onerror="this.onerror=null;this.src='images/new-2.jpg';">
          <div class="card-img-overlay d-flex">
            <a href="{{$vicharmanch[$y]->url}}" class="align-self-end">
              
              <h6 class="card-title mb-0">{{$vicharmanch[$y]->title}}</h6>
            </a>
          </div>
        </div>
      </div>
      @endfor
    </div>
    @endif    
  </div>    
</div>
<!--5th section-->
<hr class="mt-4 mb-2 mob-bdr-0 mob-dspl-none" style="border: dashed 0.5px #dee2e6;">
<!--horizontal add 1110px 75px-->
<div class="row mt-0 mb-4">
  @if(isset($parents[6]) )  
          @if($parents[6]->status==1)
          {!!$parents[6]->bscript!!}
          @else 
          @endif 
        @else
      @endif
  
</div>
<!--horizontal add 1110px 75px-->

<hr class="mt-4 mob-bdr-0" style="border: dashed 0.5px #dee2e6;">

<!--6th section-->
<div class="col-12  mt-4 p-0">
  <div class="row section_6">
    @if(isset($parents[2]))  
          @if($parents[2]->status==1)
          {!!$parents[2]->bscript!!}
          @else 
          @endif 
        @else
      @endif
    
    <div class="col-lg-4 col-md-6 pl-5 mob-p-0 p-md-3 red-r-bdr">
      @if(isset($brandSpeaks))
      @for($z = 0; $z < 1; $z++)
      <div class="row ml-0 mb-2 title-holder mob-p-10">
        <div class="widget-title-cover">
          <h5 class="widget-title">
            <a href="{{url('/')}}/{{$brandSpeaks[$z]->category_name}}-news.html">
              <span>ब्रैंड स्पीक्स</span>
            </a>  
          </h5>
          <a href="{{url('/')}}/{{$brandSpeaks[$z]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और पढ़ें</strong>
          </a>
        </div>
      </div>
      <a href="{{$brandSpeaks[$z]->url}}">
        @if($brandSpeaks[$z]->phototitle != null)
        <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$brandSpeaks[$z]->photopath}}" alt="{{$brandSpeaks[$z]->phototitle}}" title="{{$brandSpeaks[$z]->phototitle}}" onerror="this.onerror=null;this.src='images/interview-1.jpg';">
        @else
        <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$brandSpeaks[$z]->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/interview-1.jpg';">
        @endif
      </a>
      <h6 class="mt-2 mb-1 font-heading-1">
        <strong>
          <a href="{{$brandSpeaks[$z]->url}}">{{$brandSpeaks[$z]->title}}</a>
        </strong>
      </h6>
      <p>
        {{$brandSpeaks[$z]->summary}}
       
      </p>
      <hr>
      @endfor
      @for($z = 1; $z < count($brandSpeaks); $z++)  
      <div class="row p-0 m-0">
        <h6 class="mb-0">
          <a href="{{$brandSpeaks[$z]->url}}">
            <strong>{{$brandSpeaks[$z]->title}}</strong>
            
          </a>
        </h6>   
      </div>    
      <hr>
      @endfor  
      @endif       
    </div>

    <div class="col-lg-4 col-md-6 pr-5 mob-mt-30 mob-p-0 p-md-3">
      @if(isset($Adv))
      @for($p = 0; $p < 1; $p++)
      <div class="row ml-0 mb-2 title-holder mob-p-10">
        <div class="widget-title-cover">
          <h5 class="widget-title">
            <a href="{{url('/')}}/{{$Adv[$p]->category_name}}-news.html">
              <span>ऐड वर्ल्ड</span>
            </a>  
          </h5>
          <a href="{{url('/')}}/{{$Adv[$p]->category_name}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और पढ़ें</strong>
          </a>
        </div>
      </div>
      <a href="{{$Adv[$p]->url}}">
        <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$Adv[$p]->photopath}}" alt="{{$Adv[$p]->phototitle}}" title="{{$Adv[$p]->phototitle}}" onerror="this.onerror=null;this.src='images/interview-2.jpg';">
      </a>
      <h6 class="mt-2 mb-1 font-heading-1">
        <strong>
          <a href="{{$Adv[$p]->url}}">{{$Adv[$p]->title}}</a>
        </strong>
      </h6>
      <p>
        {{$Adv[$p]->summary}}
        
      </p>
      <hr>
      @endfor
      @for($p = 1; $p < count($Adv); $p++)  
      <div class="row p-0 m-0">
        <h6 class="mb-0">
          <a href="{{$Adv[$p]->url}}">
            <strong>{{$Adv[$p]->title}}</strong>
            
          </a>
        </h6>   
      </div>    
      <hr>
      @endfor 
      @endif
    </div>
    @if(isset($parents[3]))  
          @if($parents[3]->status==1)
          {!!$parents[3]->bscript!!}
          @else 
          @endif 
        @else
      @endif  
    
  </div>      
</div>
<!--6th section-->

<hr class="mt-4 mb-2 mob-bdr-0 mob-dspl-none" style="border: dashed 0.5px #dee2e6;">

<!--horizontal add 1110px 75px-->
<div class="row mt-0 mb-4">
  @if(isset($parents[7]))  
          @if($parents[7]->status==1)
          {!!$parents[7]->bscript!!}
          @else 
          @endif 
        @else
      @endif
  
</div>
<!--horizontal add 1110px 75px-->

<hr class="mt-4 mob-bdr-0" style="border: dashed 0.5px #dee2e6;">

<!--7th section-->
<div class="row mt-3 ml-lg-0 mob-m-0">
  <div class="col-lg-9 col-md-12 pl-0 pr-4 dashed-bdr-r mob-p-10 mob-bdr-0 tab-bdr">
    <div class="row">
      <div class="col-12 ml-0 mb-2 title-holder mob-mb-15">
        <div class="widget-title-cover heading-3">
          <h5 class="widget-title">
            <a href="{{url('social-media-news.html')}}">
              <span>सोशल मीडिया</span>
            </a>  
          </h5>
          <a href="{{url('social-media-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और पढ़ें</strong>
          </a>
        </div>
      </div>
      <!--Carousel Wrapper-->
      <div id="multi-item-example" class="carousel slide carousel-multi-item mb-5" data-ride="carousel">

        <!--Controls-->
        <div class="controls-top custom-slides-control">
          <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
          <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a>
        </div>
        <!--/.Controls-->

  <!--Indicators--
  <ol class="carousel-indicators">
    <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
    <li data-target="#multi-item-example" data-slide-to="1"></li>
    <li data-target="#multi-item-example" data-slide-to="2"></li>
  </ol>
  !--/.Indicators-->

  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    @if(isset($socialM))
    <!--First slide-->
    <div class="carousel-item active">
      @for($q = 0; $q < 3; $q++)
      <div class="col-md-4  mob-bdr-0"> 
        <a href="{{$socialM[$q]->url}}">
          @if($socialM[$q]->phototitle != null)
          <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$socialM[$q]->photopath}}" alt="{{$socialM[$q]->phototitle}}" title="{{$socialM[$q]->phototitle}}" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
          @else
          <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$socialM[$q]->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
          @endif
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong><a href="{{$socialM[$q]->url}}">{{$socialM[$q]->title}}</a>
          </strong>
        </h6>
        <p>
          <small>
            {{$socialM[$q]->summary}}
            
          </small>
        </p>
      </div>

      @endfor

    </div>
    <!--/.First slide-->

    <!--Second slide-->
    <div class="carousel-item">
      @for($q = 3; $q < 6; $q++)
      <div class="col-md-4  mob-bdr-0"> 
        <a href="{{$socialM[$q]->url}}">
          @if($socialM[$q]->phototitle != null)
          <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$socialM[$q]->photopath}}" alt="{{$socialM[$q]->phototitle}}" title="{{$socialM[$q]->phototitle}}" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
          @else
          <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$socialM[$q]->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
          @endif
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong>
            <a href="{{$socialM[$q]->url}}">{{$socialM[$q]->title}}</a>
          </strong>
        </h6>
        <p>
          <small>{{$socialM[$q]->summary}}
        </small>
      </p>
    </div>
    @endfor  
  </div>
  <!--/.Second slide-->    
  @endif
</div>
<!--/.Slides-->
</div>
<!--/.Carousel Wrapper-->
</div>

<hr class="mt-1" style="border: dashed 0.5px #dee2e6;">

<div class="row mt-4 ml-lg-0">        
  <div class="col-lg-4 col-md-5 col-xs-4 col-sm-4 pr-4 mob-p-30">
    <div class="row media-form">
      <div class="row ml-0 title-holder">
        <div class="widget-title-cover yellow-hed">
          <h5 class="widget-title">
            <a href="{{url('telescope-news.html')}}">
              <span>टेलिस्कोप</span>
            </a>  
          </h5>
          <a href="{{url('telescope-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white"><strong>और पढ़ें</strong>
          </a>
        </div>
      </div>        
      <ul class="scrollbar style-4 mt-3 pr-3">
        @php $sr = 1; @endphp
        @if(isset($telS))
        @foreach($telS as $tS)
        <li >
          <span class="big-number text-dark">{{$sr}}.</span>
          <a href="{{$tS->url}}">{{$tS->title}}</a> 
          
        </li>
        @php $sr++; @endphp  
        @endforeach  
        @endif
      </ul>   
    </div>
    <hr class="mt-4">
    <!--सब्सक्राइब-->
    <form name="form1" method="post" class="text-center" id="subform" >
    {{csrf_field()}}
    <div class="row mt-4">
      <div class="col-md-12 text-white p-0 bg-dark rounded">

        <h4 class="text-white bg-warning p-1 pl-3 rounded-top" style="border-bottom: dotted #000000 2px;font-family: 'Rajdhani', sans-serif; font-weight: 700;">सब्सक्राइब</h4> 
        <h5 class="pl-3" style="line-height: 35px;">न्यूजलेटर पाने के लिए यहां सब्सक्राइब कीजिए</h5>
        <div id="semail_err"></div>
        <div class="form-group p-3 mb-0">
          <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <p class="text-center">
          <input type="button" value="Subscribe" class="btn btn-warning btn-sm" onclick="front_subcribe_form()">
          
        </p>

      </div>
    </div>

  </form>
  <div class="modal fade" id="thankyouModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <p id="thx"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!--सब्सक्राइब-->
</div>



  <div class="col-lg-8 col-md-7 text-left pt-0 pl-4">

    <div class="row pl-0 mb-3 ml-0 title-holder">
      <h5 class="mb-0 heading-bdr">
        <strong>
          <a href="{{url('patrakar-kavi-news.html')}}">
            <span class="bg-white pr-3">पत्रकार कवि</span>
          </a>
        </strong>
        <small>
          <a href="{{url('patrakar-kavi-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white"><strong>और पढ़ें</strong>
          </a>
        </small>
      </h5>
    </div>
    @if(isset($poetry))   
      <div class="row pb-3">
         @for($jo = 0; $jo < 2; $jo++)
        <div class="col-md-6  mob-bdr-0"> 
          <a href="{{$poetry[$jo]->url}}">
            @if($poetry[$jo]->phototitle != null)
            <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$poetry[$jo]->photopath}}" alt="{{$poetry[$jo]->phototitle}}" title="{{$poetry[$jo]->phototitle}}" onerror="this.onerror=null;this.src='images/vichar-story1.jpg';">
            @else
            <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$poetry[$jo]->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/vichar-story1.jpg';">
            @endif
          </a>
          <h6 class="mt-2 font-heading-1">
            <strong>
              <a href="{{$poetry[$jo]->url}}">
                {{$poetry[$jo]->title}}
              </a>
            </strong>
          </h6>
          <p>
            {{$poetry[$jo]->summary}}
            
          </p>
        </div>
         @endfor
         @for($jo = 2; $jo < count($poetry); $jo++)
        <div class="col-md-6"> 
          <a href="{{$poetry[$jo]->url}}">
            @if($poetry[$jo]->phototitle != null)
            <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$poetry[$jo]->photopath}}" alt="{{$poetry[$jo]->phototitle}}" title="{{$poetry[$jo]->phototitle}}" onerror="this.onerror=null;this.src='images/vichar-story2.jpg';">
            @else
            <img class="img-fluid img-thumbnail" data-src="{{Config::get('constants.newstorage')}}{{$poetry[$jo]->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/vichar-story2.jpg';">
            @endif
          </a>
          <h6 class="mt-2 font-heading-1">
            <strong>
              <a href="{{$poetry[$jo]->url}}">
              {{$poetry[$jo]->title}}</a>
            </strong>
          </h6>
          <p>
            {{$poetry[$jo]->summary}}
            
          </p>
        </div>
        @endfor
      </div>      
      @endif
    </div>
  </div>    
</div>

<div class="col-lg-3 col-md-12 mob-m-auto pl-4 mob-p-10">
  <div class="col-lg-12 col-md-7 m-0 p-0 float-md-left">
    <div class="col-12 p-0 ml-0 title-holder">
      <div class="widget-title-cover heading-3">
        <h5 class="widget-title">
          <span>टेक वर्ल्ड</span>
        </h5>
        <a href="{{url('techworld-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
          <strong>और पढ़ें</strong>
        </a>
      </div>
    </div>                  
    <ul id="nt-example1">
      @if(isset($tech))
      @foreach($tech as $sM)
      <li>
        <a href="{{$sM->url}}">{{$sM->title}}
          
        </a>
      </li>
      @endforeach  
      @endif
    </ul>
  </div>


  <div class="row col-lg-12 col-md-5 text-center pr-0 m-lg-0 p-lg-0">
    @if(isset($parents[4]))  
          @if($parents[4]->status==1)
          {!!$parents[4]->bscript!!}
          @else 
          @endif 
        @else
      @endif
    
    @if(isset($parents[5]))  
          @if($parents[5]->status==1)
          {!!$parents[5]->bscript!!}
          @else 
          @endif 
        @else
      @endif
    
  </div>

</div>

</div>


<hr class="mt-4 mb-2 mob-bdr-0 mob-dspl-none" style="border: dashed 0.5px #dee2e6;">

<!--horizontal add 1110px 75px-->
<div class="row mt-0 mb-4">
   @if(isset($parents[8]))  
          @if($parents[8]->status==1)
          {!!$parents[8]->bscript!!}
          @else 
          @endif 
        @else
      @endif
  
</div>
  <!--horizontal add 1110px 75px-->

  <hr class="mt-4 mb-0 mob-bdr-0 mob-dspl-none" style="border: dashed 0.5px #dee2e6;">


  <!--7th section-->
  <!--8th add section-->
  <div class="row mt-3 ml-lg-0">
    <div class="col-lg-6 col-md-12 m-md-auto pl-0 dashed-bdr-r mob-p-0 mob-bdr-0 tab-bdr">
      @if(isset($frontalbum))
      <div class="row ml-0 mb-2 title-holder mob-p-10">
        <div class="widget-title-cover yellow-hed">
          <a href="{{url('news/photos.html')}}">
          <h5 class="widget-title">  
            <span>फोटो गैलरी</span>
          </h5>
          </a>
          <a href="{{url('news/photos.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
            <strong>और देखें</strong>
          </a>
        </div>
      </div>
        <!--Carousel Wrapper-->
        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails mb-0" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner full-gallery-img" role="listbox">
            @for($al=0;$al < 1;$al++)
            <div class="carousel-item active"> 
              <a href="{{url('news/photo').'/'.str_slug($frontalbum[$al]->album_title).'-'.$frontalbum[$al]->albumId}}">
                <img class="d-block w-100" data-src="{{Config::get('constants.newstorage')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->album_title}}" title="{{$frontalbum[$al]->album_title}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">                
              </a>
            </div>
            @endfor
            @for($al=1;$al < 10;$al++)
            <div class="carousel-item"> 
              <a href="{{url('news/photo').'/'.str_slug($frontalbum[$al]->album_title).'-'.$frontalbum[$al]->albumId}}">
                <img class="d-block w-100" data-src="{{Config::get('constants.newstorage')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->album_title}}" title="{{$frontalbum[$al]->album_title}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
              </a>
            </div>
            @endfor
          </div>
          <!--/.Slides-->
          <!--Controls-->
          <a class="carousel-control-prev left115" href="#carousel-thumb" role="button" data-slide="prev">
           <i class="fas fa-angle-left text-white"></i>
         </a>
         <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
          <i class="fas fa-angle-right text-white"></i>
        </a>  
        <!--/.Controls-->
        <ol class="carousel-indicators image-gallery scrollbar style-4">
          @for($al=0;$al < 1;$al++)
          <li data-target="#carousel-thumb" data-slide-to="{{$al}}" class="active"> 
            <img class="d-block w-100 img-thumbnail" data-src="{{Config::get('constants.newstorage')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->album_title}}" title="{{$frontalbum[$al]->album_title}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
          </li>
          @endfor
          @for($al=1;$al < 10;$al++)
          <li data-target="#carousel-thumb" data-slide-to="{{$al}}">
            <img class="d-block w-100 img-thumbnail" data-src="{{Config::get('constants.newstorage')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->album_title}}" title="{{$frontalbum[$al]->album_title}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
          </li>
          @endfor
          </ol>
        </div>
        <!--/.Carousel Wrapper-->
        @endif
      </div>
      
      <div class="col-lg-6 col-md-12 m-md-auto">
        @if(isset($videos))
        <div class="row ml-0 mb-2 title-holder mob-mt-30 mob-mb-15  mt-md-4">
          <div class="widget-title-cover heading-3">
            <h5 class="widget-title">
              <a href="{{url('news/videos.html')}}">
                <span>विडियो</span>
              </a>
            </h5>
            <a href="{{url('news/videos.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
              <strong>और देखें</strong>
            </a>
          </div>
        </div>
          <div class="row">
            @for($vc=0;$vc < 1; $vc++)
            <div class="col-lg-9 col-md-12 video-selected mob-p-0">
              <div class="video-iframe" style="padding-top:0px !important">
                <span class="video-icon"><i class="fas fa-play-circle text-danger fa-2x"></i></span>
                <a href="{{url('news/video').'/'.str_replace(' ','-',$videos[$vc]->title).'-'.$videos[$vc]->yid}}">
                  <img data-src="{{$videos[$vc]->img_thumb}}" alt="{{$videos[$vc]->title}}" title="{{$videos[$vc]->title}}" width="390" height="235" onerror="this.onerror=null;this.src='images/top-story1.jpg';" >
                </a>                
              </div>
            </div>
            @endfor
            <div class="col-lg-3 col-md-12 m-md-auto video-thumbnails video-gallery scrollbar style-4">
              @foreach($videos as $v)
              <div class="video-thumb position-relative">
                <span class="video-icon-inner"><i class="fas fa-play-circle text-danger" style="background: white;padding: 1px;"></i></span>
                <img class="card-img img-fluid" data-src="{{$v->img_thumb}}" data-url="{{url('news/video').'/'.str_replace(' ','-',$v->title).'-'.$v->yid}}" alt="{{$v->title}}" title="{{$v->title}}" onerror="this.onerror=null;this.src='images/top-story1.jpg';">
              
              </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  <!--8th add section-->

</div>
<!--middle-body-->

@endsection
