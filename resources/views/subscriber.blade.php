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
    <!--center-part--><div class="row mob-p-0 mob-m-0">
  
    <!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar">
  
    <div class="theiaStickySidebar">
    <nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
    <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
    <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
    <li class="breadcrumb-item active">subscribe</li>
  </ol></small>
</nav>
    
    
  
    
        
    <div class="row">
      
    
      <div class="col-md-12 m-auto">
        <!--सब्सक्राइब-->
    <form name="form1" method="post" class="text-center" id="subform" >
    {{csrf_field()}}
        <div class="subscribe-page text-center">
        <i class="far fa-envelope-open subscribe-icon"></i>
        <h1>सब्सक्राइब</h1>
          <h3>न्यूजलेटर पाने के लिए यहां सब्सक्राइब कीजिए</h3>
          
          <div id="subscribe_page_semail_err"></div>
            <div class="row m-0 mt-4">
    
            <div class="col-md-12 m-auto">
              <div class="row m-0">
                <div class="col-lg-9 pr-0 mb-4">
                <input type="email" name="sub_email"  id="subscribe_page_email" class="form-control btn-rounded">
                </div>
                <div class="col-lg-3">
                <button type="button" class="btn btn-rounded btn-md m-0 border-warning border bg-transparent text-dark mb-4" onclick="subscribe_page_form()"><strong>SUBSCRIBE</strong></button>
                </div>
                </div>
              </div>
              
              </div>
  
          
        </div>
      </form>
        
        
        
      </div>
    
      
      
    
    </div>
  
  </div>
  
    
    </div><!--left-part-->
    
  
@include('partials.rightsidebar')
    
  
    </div><!--center-part-->
    

  
  </div>
  <!--middle-body-->

@endsection      