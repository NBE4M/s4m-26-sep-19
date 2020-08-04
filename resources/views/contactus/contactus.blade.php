@extends('partials.app')

@section('content')
<main role="main">
<div class="container bw">
<div class="col no-padding p10 text-center">

</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
  </ol>
</nav>

<!--MAIN FIRST ROW START-->
<div class="col no-padding mt10">
<div class="row">




<!--MIDDLE TOP NEWS START here-->
<div class="col-md-12 col-lg-8 col-12 col-sm-12 content box">
<div class="theiaStickySidebar">


 <div class="row mt-2 no-gutters border-bottom-pnk">
<h5 class="flama text-uppercase mb-0"><kbd><i class="far fa-address-book"></i> Contact Us</kbd>   </h5>            
                 </div> 
 
 
 <div class="row mt-2">
 <div class="col-lg-12 d-flex flogo-group mt-5">
 <div class="col-lg-4 col-12 float-left bgtin1 brightw">
 <h5 class="address bg-black"><strong>NOIDA OFFICE</strong></h5>
 <p class="f14 pt-2">ADSERT WEB SOLUTIONS PVT. LTD. 
B-20, SECTOR 57 
NOIDA (U.P) 201301
PH: (0120) 4007700</p>
 </div>

 
  <div class="col-lg-4 col-12 float-left bgtin2 brightw">
 <h5 class="address bg-black"><strong>MUMBAI OFFICE</strong></h5>
  <p class="f14 pt-2">301, KAKAD BHAVAN, 
3RD FLOOR, 11TH STREET,
OPP. GALAXY CINEMA, BANDRA WEST, MUMBAI, 400050 
PH: (022) 66206000</p>
  </div>

  
   <div class="col-lg-4 col-12 float-left bgtin3">
   <h5 class="address bg-black"><strong>BANGALORE OFFICE</strong></h5>
   <p class="f14 pt-2">ADSERT WEB SOLUTIONS PVT. LTD 
#18, 3RD B CROSS, 
OPPOSITE BANGALORE PUBLIC SCHOOL, 
DOMLUR 2ND STAGE, BANGALORE-560071 
PH: (080) 41119469</p>
   </div>
</div>
   
 </div>
 
 
 
 <div class="row mt-5">
 <div class="col-lg-12">
 <h5 class="panel-title flama text-uppercase"><span class="txt-title">Contact <span class="pnk">with us</span></span></h5>
 </div>
 <div class="col-lg-6 mt-4">
 
  <form role="form" action="{{url('contact-info')}}" method="post">
    {{ csrf_field() }}
    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" required class="form-control" name="c_name" id="c_name">
  </div>
  <div class="form-group">
    <label for="pwd">E-mail:</label>
    <input type="email" required class="form-control" name="c_email" id="c_email">
  </div>
  
  <div class="form-group">
    <label for="pwd">Subject:</label>
    <input type="text" required class="form-control" name="c_subject" id="c_subject">
  </div>
  
  <div class="form-group">
    <label for="pwd">Message:</label>
    
    <textarea required class="form-control" rows="5" name="c_message" id="c_message"></textarea>
  </div>
  
   <button type="submit" class="btn btn-primary">Submit</button>
</form>
 
 
 
 </div>
  <div class="col-lg-6 mt-4">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7280.702442149869!2d77.35349831188871!3d28.60479669716083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce56d332ef83d%3A0x862ac30ce8d66013!2sExchange4media!5e0!3m2!1sen!2sin!4v1495622403733" width="100%" height="450" frameborder="0" style="border: 2px solid #dcdcdc;" allowfullscreen=""></iframe>
  </div>
 </div>
 
 
 <div class="row mt-5">
 <div class="col-lg-12">
 <h3 class="tm"><span>Team Details</span></h3>
 </div>
 </div>
 
 
 
  <div class="row mt-2 team">
  
<div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid">
  </figure>
  <h6 class="flama mt-2">Annurag Batra <br>
  (Chairman &amp; Editor in Chief)
  </h6>
  <p class="date"><a href="mailto:abatra@exchange4media.com">abatra@exchange4media.com</a><br>
 (0120) 4007700</p>
  </div>
  
  <div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid">
  </figure>
 <h6 class="flama mt-2">Nawal Ahuja  <br>
  (Co Founder &amp; Director) 
  </h6>
  <p class="date"><a href="mailto:nahuja@exchange4media.com">nahuja@exchange4media.com</a><br>
 (022) 66206000</p>
  </div>
  
   <div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid">
  </figure>
 <h6 class="flama mt-2">Sunil Kumar <br>
  (President)
  </h6>
  <p class="date"><a href="mailto:sunil.kumar@exchange4media.com">sunil.kumar@exchange4media.com</a><br>
 (022) 66206000</p>
  </div>

 </div>
 
</div> 
</div>
<!--MIDDLE TOP NEWS END here-->

@include('partials.rightsidebar')

</div>
</div>
<!--MAIN FIRST ROW END-->
</div>
</main>
@endsection           