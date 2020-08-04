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
        @php
        $rows_articlehomeslide='1';
        @endphp
        @foreach($homeSlide as $keyhomeslide)
        @if($keyhomeslide->sequence=='1')
        @php
        $rows_articlehomeslide++;
        @endphp

        <div class="carousel-item active">
          <div class="card bg-dark text-white">
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story1.jpg';"></a>
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
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story2.jpg';"></a>
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
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story3.jpg';"></a>
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
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story4.jpg';"></a>
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
            <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story4.jpg';"></a>
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
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story1.jpg';"></a>
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
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story2.jpg';"></a>
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
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story3.jpg';"></a>
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
          <a href="{{$keyhomeslide->url}}"><img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$keyhomeslide->photopath}}" alt="{{$keyhomeslide->phototitle}}" title="{{$keyhomeslide->phototitle}}" onerror="this.onerror=null;this.src='images/top-story4.jpg';"></a>
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
    @if(isset($customSection))
    @for($cus=0;$cus < 1;$cus++)
    <strong>
      <a href="{{$customSection[$cus]->category_hname}}-news.html">
        <span class="bg-white pl-3 pr-3">इंडस्ट्री ब्रीफिंग</span>
      </a>
    </strong>
    <small>
      <a href="{{$customSection[$cus]->category_hname}}-news.html" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
        <strong>और पढ़ें</strong>
      </a>
    </small>
    @endfor
  </h5>
</div>

<div class="row industry-brefing mt-lg-3 p-3 mob-mt-15 tab-mt-0 rounded mb-bg-light m-lg-0">
  @foreach($customSection as $cus)
  <div class="col-md-3 mob-mb-15">
    <div class="row">
      <div class="col-6 col-sm-12 col-md-12 col-lg-6 pr-0">
        <a href="{{$cus->url}}">
          <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$cus->photopath}}" alt="{{$cus->phototitle}}" title="{{$cus->phototitle}}" onerror="this.onerror=null;this.src='images/industry-story1.jpg';">
        </a>
      </div>
      <div class="col-6 col-sm-12 col-md-12 col-lg-6 pr-0 pt-lg-0 pl-lg-2 pl-md-3 pt-md-1">
        <h6 class="mb-0">
          <a href="{{$cus->url}}">
            <strong>{{$cus->title}}</strong>
          </a>
        </h6>
        <small class="date text-white tab-date-muted">
          <i class="far fa-clock"></i> 
        </small>
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
  <hr class="mt-4 mb-4" style="border: dashed 0.5px #dee2e6;">
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
        <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $mF->pickdate)->diffForHumans()}}</small>
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
          <img class="img-fluid img-thumbnail border-0" src="{{Config::get('constants.storagepath')}}{{$jobs[0]->photopath}}" alt="{{$jobs[0]->phototitle}}" title="{{$jobs[0]->phototitle}}" onerror="this.onerror=null;this.src='images/new-1.jpg';">
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong><a href="{{ $jobs[0]->url }}">{{$jobs[0]->title}}</a></strong>
        </h6>
        <p>
          {{ $jobs[0]->summary }}

        </p>


           <p> <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jobs[0]->pickdate)->diffForHumans()}}</small></p>

          <br>
        <hr>
        <div class="row mt-1 mb-2 ml-0 mr-0">
         <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0">
           <a href="{{ $jobs[1]->url }}">
             <img class="img-fluid img-thumbnail border-0" src="{{Config::get('constants.storagepath')}}{{$jobs[1]->photopath}}" alt="{{$jobs[1]->phototitle}}" title="{{$jobs[1]->phototitle}}" onerror="this.onerror=null;this.src='images/admision-story2.jpg';">
           </a>
         </div>
         <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2">
           <h6 class="mb-0">

               <a href="{{ $jobs[1]->url }}"><strong>{{ $jobs[1]->title }}</strong></a>

             <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jobs[1]->pickdate)->diffForHumans()}}</small>
           </h6>
         </div>
       </div>
      </div>


      <div class="col-md-6 media-form mob-admsn-reltd">
        @for($x = 2; $x < count($jobs); $x++ )
        <div class="row mt-1">
          <div class="col-6 col-sm-12 col-md-5 col-lg-5 pr-0">
            <a href="{{ $jobs[$x]->url }}">
              <img class="img-fluid img-thumbnail border-0" src="{{Config::get('constants.storagepath')}}{{$jobs[$x]->photopath}}" alt="{{$jobs[$x]->phototitle}}" title="{{$jobs[$x]->phototitle}}" onerror="this.onerror=null;this.src='images/admision-story2.jpg';">
            </a>
          </div>
          <div class="col-6 col-sm-12 col-md-7 col-lg-7 pr-0 pl-2">
            <h6 class="mb-0">

                <a href="{{ $jobs[$x]->url }}"><strong>{{ $jobs[$x]->title }}</strong></a>

              <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $jobs[$x]->pickdate)->diffForHumans()}}</small>
            </h6>
          </div>
        </div>
        <hr>
        @endfor
        @endif
      </div>
    </div>
  </div>

      @if(isset($parents[1]))
          @if($parents[1]->status==1)
          {!!$parents[1]->bscript!!}
          @else
          @endif
        @else
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
        <a href="{{$mostRead[$mre]->category_name}}-news.html">
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
             <img class="img-fluid img-thumbnail border-0" src="{{Config::get('constants.storagepath')}}{{$mR->photopath}}" alt="{{$mR->phototitle}}" title="{{$mR->phototitle}}" onerror="this.onerror=null;this.src='images/lok-news.jpg';" >
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
      <small class="float-right date mt-2"><i class="far fa-clock"></i>
        {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $mR->pickdate)->diffForHumans()}}
      </small>
    </p>
  </div>
  @else
    <div class="col-lg-4 col-md-6 media-form dashed-bdr-r mob-p-0 mob-bdr-0">
    <div class="card bg-dark text-white">
          <a href="{{$mR->url}}">
             <img class="img-fluid img-thumbnail border-0" src="{{Config::get('constants.storagepath')}}{{$mR->photopath}}" alt="{{$mR->phototitle}}" title="{{$mR->phototitle}}" onerror="this.onerror=null;this.src='images/lok-news.jpg';">
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
      <small class="float-right date mt-2"><i class="far fa-clock"></i>
        {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $mR->pickdate)->diffForHumans()}}
      </small>
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
          <img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$interview[$i]->photopath}}" alt="{{$interview[$i]->phototitle}}" title="{{$interview[$i]->phototitle}}" onerror="this.onerror=null;this.src='images/brand-1.jpg';">
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
          <img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$interview[$i]->photopath}}" alt="{{$interview[$i]->phototitle}}" title="{{$interview[$i]->phototitle}}" onerror="this.onerror=null;this.src='images/brand-2.jpg';">
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
          <img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$vicharmanch[$y]->photopath}}" alt="{{$vicharmanch[$y]->phototitle}}" title="{{$vicharmanch[$y]->phototitle}}" onerror="this.onerror=null;this.src='images/new-1.jpg';">
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
          <img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$vicharmanch[$y]->photopath}}" alt="{{$vicharmanch[$y]->phototitle}}" title="{{$vicharmanch[$y]->phototitle}}" onerror="this.onerror=null;this.src='images/new-2.jpg';">
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
        <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$brandSpeaks[$z]->photopath}}" alt="{{$brandSpeaks[$z]->phototitle}}" title="{{$brandSpeaks[$z]->phototitle}}" onerror="this.onerror=null;this.src='images/interview-1.jpg';">
      </a>
      <h6 class="mt-2 mb-1 font-heading-1">
        <strong>
          <a href="{{$brandSpeaks[$z]->url}}">{{$brandSpeaks[$z]->title}}</a>
        </strong>
      </h6>
      <p>
        {{$brandSpeaks[$z]->summary}}
        <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $brandSpeaks[$z]->pickdate)->diffForHumans()}}</small>
      </p>
      <hr>
      @endfor
      @for($z = 1; $z < count($brandSpeaks); $z++)
      <div class="row p-0 m-0">
        <h6 class="mb-0">
          <a href="{{$brandSpeaks[$z]->url}}">
            <strong>{{$brandSpeaks[$z]->title}}</strong>
            <small class="float-right date mt-2">
              <i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $brandSpeaks[$z]->pickdate)->diffForHumans()}}
            </small>
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
        <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$Adv[$p]->photopath}}" alt="{{$Adv[$p]->phototitle}}" title="{{$Adv[$p]->phototitle}}" onerror="this.onerror=null;this.src='images/interview-2.jpg';">
      </a>
      <h6 class="mt-2 mb-1 font-heading-1">
        <strong>
          <a href="{{$Adv[$p]->url}}">{{$Adv[$p]->title}}</a>
        </strong>
      </h6>
      <p>
        {{$Adv[$p]->summary}}
        <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $Adv[$p]->pickdate)->diffForHumans()}}</small>
      </p>
      <hr>
      @endfor
      @for($p = 1; $p < count($Adv); $p++)
      <div class="row p-0 m-0">
        <h6 class="mb-0">
          <a href="{{$Adv[$p]->url}}">
            <strong>{{$Adv[$p]->title}}</strong>
            <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $Adv[$p]->pickdate)->diffForHumans()}}</small>
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
          <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$socialM[$q]->photopath}}" alt="{{$socialM[$q]->phototitle}}" title="{{$socialM[$q]->phototitle}}" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong><a href="{{$socialM[$q]->url}}">{{$socialM[$q]->title}}</a>
          </strong>
        </h6>
        <p>
          <small>
            {{$socialM[$q]->summary}}
            <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $socialM[$q]->pickdate)->diffForHumans()}}</small>
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
          <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$socialM[$q]->photopath}}" alt="{{$socialM[$q]->phototitle}}" title="{{$socialM[$q]->phototitle}}" onerror="this.onerror=null;this.src='images/telecop-story1.jpg';">
        </a>
        <h6 class="mt-2 font-heading-1">
          <strong>
            <a href="{{$socialM[$q]->url}}">{{$socialM[$q]->title}}</a>
          </strong>
        </h6>
        <p>
          <small>{{$socialM[$q]->summary}}<small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $socialM[$q]->pickdate)->diffForHumans()}}</small>
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
          <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tS->pickdate)->diffForHumans()}}</small>
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
          <a href="{{url('poetry-news.html')}}">
            <span class="bg-white pr-3">पत्रकार कवि</span>
          </a>
        </strong>
        <small>
          <a href="{{url('poetry-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white"><strong>और पढ़ें</strong>
          </a>
        </small>
      </h5>
    </div>
    @if(isset($poetry))
      <div class="row pb-3">
         @for($jo = 0; $jo < 2; $jo++)
        <div class="col-md-6  mob-bdr-0">
          <a href="{{$poetry[$jo]->url}}">
            <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$poetry[$jo]->photopath}}" alt="{{$poetry[$jo]->phototitle}}" title="{{$poetry[$jo]->phototitle}}" onerror="this.onerror=null;this.src='images/vichar-story1.jpg';">
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
            <small class="float-right date mt-2">
              <i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $poetry[$jo]->pickdate)->diffForHumans()}}
            </small>
          </p>
        </div>
         @endfor
         @for($jo = 2; $jo < count($poetry); $jo++)
        <div class="col-md-6">
          <a href="{{$poetry[$jo]->url}}">
            <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$poetry[$jo]->photopath}}" alt="{{$poetry[$jo]->phototitle}}" title="{{$poetry[$jo]->phototitle}}" onerror="this.onerror=null;this.src='images/vichar-story2.jpg';">
          </a>
          <h6 class="mt-2 font-heading-1">
            <strong>
              <a href="{{$poetry[$jo]->url}}">
              {{$poetry[$jo]->title}}</a>
            </strong>
          </h6>
          <p>
            {{$poetry[$jo]->summary}}
            <small class="float-right date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $poetry[$jo]->pickdate)->diffForHumans()}}</small>
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
          <small class="float-right text-white date mt-2"><i class="far fa-clock"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sM->pickdate)->diffForHumans()}}</small>
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
                <img class="d-block w-100" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->phototitle}}" title="{{$frontalbum[$al]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
              </a>
            </div>
            @endfor
            @for($al=1;$al < 10;$al++)
            <div class="carousel-item">
              <a href="{{url('news/photo').'/'.str_slug($frontalbum[$al]->album_title).'-'.$frontalbum[$al]->albumId}}">
                <img class="d-block w-100" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->phototitle}}" title="{{$frontalbum[$al]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
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
            <img class="d-block w-100 img-thumbnail" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->phototitle}}" title="{{$frontalbum[$al]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
          </li>
          @endfor
          @for($al=1;$al < 10;$al++)
          <li data-target="#carousel-thumb" data-slide-to="{{$al}}">
            <img class="d-block w-100 img-thumbnail" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$al]->photopath}}" alt="{{$frontalbum[$al]->phototitle}}" title="{{$frontalbum[$al]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
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
                  <img src="{{$videos[$vc]->img_thumb}}" alt="{{$videos[$vc]->title}}" title="{{$videos[$vc]->phototitle}}" width="390" height="235" onerror="this.onerror=null;this.src='images/top-story1.jpg';" >
                </a>
              </div>
            </div>
            @endfor
            <div class="col-lg-3 col-md-12 m-md-auto video-thumbnails video-gallery scrollbar style-4">
              @foreach($videos as $v)
              <div class="video-thumb position-relative">
                <span class="video-icon-inner"><i class="fas fa-play-circle text-danger" style="background: white;padding: 1px;"></i></span>
                <img class="card-img img-fluid" src="{{$v->img_thumb}}" data-url="{{url('news/video').'/'.str_replace(' ','-',$v->title).'-'.$v->yid}}" alt="{{$v->title}}" title="{{$v->phototitle}}" onerror="this.onerror=null;this.src='images/top-story1.jpg';">

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
