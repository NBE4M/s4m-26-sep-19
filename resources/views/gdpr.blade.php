@extends('partials.app')
@section('content')

  <!--middle-body-->
  <div class="container mt-65 mb-4 mob-mt-75">
<!--Breaking News-->
  @if(isset($breaking))
  <div class="row m-lg-0">
    <div class="breaking_news">
      <div class="label ripple">Breaking News</div>
      <div class="news_title">
        <marquee>
        <strong>
          
            @if($breaking->news_url == '#')
            
              {{$breaking->news_title}}
            
            @else
            <a href="{{$breaking->news_url}}">
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
    <!--center-part--><div class="row mob-p-0 mob-m-0">
  
    <!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar">
  
    <div class="theiaStickySidebar"> 
    <nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
    <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
    <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
    <li class="breadcrumb-item active">GDPR Compliance</li>
  </ol></small>
</nav>
    
    
  
    
    <div class="row no-gutters">
                    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 no-padding term">
    <h5 class="dashed-bdr-b pb-2"><strong>GDPR Compliance</strong></h5>
    
    <p>From May 25, 2018, The General Data Protection Regulation (GDPR) is effective and we at Samachar4Media are committed to protecting information that we collect in the best possible manner. In order to comply with the GDPR we have planned for some changes that include:</p>  
  <ul>      
<li>Opt - in: Where we control the information, we will ensure that your consent is taken before the information is collected. You will also be able to review our updated privacy policy.</li>
<li>Updating our legal agreements to ensure they are GDPR compliant</li>
<li>Updating our systems and processes to meet the requirements of GDPR</li>
</ul>

    </div>
                    
                                    </div>
  
  
  
  </div>  
    </div><!--left-part-->
    
  
@include('partials.rightsidebar')
    
  
    </div><!--center-part-->
    

  
  </div>
  <!--middle-body-->

@endsection      