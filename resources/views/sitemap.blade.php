@extends('partials.app')
@section('content')

	<!--middle-body-->
	<div class="container mt-65 mb-4 mob-mt-75">

		
		<!--center-part--><div class="row mob-p-0 mob-m-0">
	
		<!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar" >
		<div class="theiaStickySidebar">
		
		<nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active">Data</li>
  </ol></small>
</nav>
		
		
		<div class="row m-0 tagspage">
			<a href="{{url('/')}}"><button type="button" class="btn tags-btn">HOME</button></a>
			@if(isset($sitemap)) 
			@foreach($sitemap as $s)
			@if($s->slug == 'photos' || $s->slug == 'videos' || $s->slug == 'author' || $s->slug == 'latest/articles')
	          <a href="{{url('/')}}/news/{{$s->slug}}.html"><button type="button" class="btn tags-btn">{{ $s->title }}</button></a>
	        @else
	          <a href="{{url('/')}}/{{$s->slug}}-news.html"><button type="button" class="btn tags-btn">{{ $s->title }}</button></a>
	        @endif
			@endforeach
			@endif 
			<!-- <a href="#"><button type="button" class="btn tags-btn">ऐड वर्ल्ड</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">लोकप्रिय खबरें</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">टेलिस्कोप</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">ब्रैंड स्पीक्स</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">विचार मंच</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">साक्षात्कार</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">मीडिया फोरम</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">मुख्य खबरें</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">एडमिशन-जॉब्स</button></a> 
			<a href="#"><button type="button" class="btn tags-btn">संपर्क करें</button></a> --> 	
	</div>

		
<hr class="mt-4 bdr">
		

		</div>
		
		</div><!--left-part-->
		
@include('partials.rightsidebar')
		
	
		</div><!--center-part-->
		

	
	</div>
	<!--middle-body-->
	


@endsection      