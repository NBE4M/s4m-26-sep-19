@extends('partials.app')
@section('content')
@if(session()->has('message'))
    <script>alert("{{ session()->get('message') }}")</script>>
        
@endif
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

						@if($breaking->news_url == '#' || $breaking->news_url == '' || $breaking->news_url == null)

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

		<!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar" >
			<div class="theiaStickySidebar">

				<nav aria-label="breadcrumb">
					<small> <ol class="breadcrumb bg-white text-warning p-0">
						<li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
						<li class="breadcrumb-item"><a href="{{Request::url()}}">संपर्क करें</a></li>

					</ol></small>
				</nav>
				@if(isset($parents[4]))  
				@if($parents[4]->status==1)
				{!!$parents[4]->bscript!!}
				@else 
				@endif 
				@else
				@endif

				<div class="row m-0">


					<div class="col-lg-4 col-12 bdr-solid-r border-warning pl-lg-0">
						<h5 class="dashed-bdr-b pb-2"><strong>NOIDA OFFICE</strong></h5>
						<p><small>ADSERT WEB SOLUTIONS PVT. LTD. B-20, SECTOR 57 NOIDA (U.P) 201301 PH: (0120) 4007700</small></p>
					</div>	

					<div class="col-lg-4 col-12 bdr-solid-r border-warning">
						<h5 class="dashed-bdr-b pb-2"><strong>MUMBAI OFFICE</strong></h5>
						<p><small>301, KAKAD BHAVAN, 3RD FLOOR, 11TH STREET, OPP. GALAXY CINEMA, BANDRA WEST, MUMBAI, 400050 PH: (022) 66206000</small></p>
					</div>	

					<div class="col-lg-4 col-12">
						<h5 class="dashed-bdr-b pb-2"><strong>BANGALORE OFFICE</strong></h5>
						<p><small>ADSERT WEB SOLUTIONS PVT. LTD #18, 3RD B CROSS, OPPOSITE BANGALORE PUBLIC SCHOOL, DOMLUR 2ND STAGE, BANGALORE-560071 PH: (080) 41119469</small></p>
					</div>	

				</div>

				<hr class="mt-4 bdr">

				<div class="row mt-4 ml-0">

					<div class="col-lg-6 col-12 pl-0 pr-4 dashed-bdr-r">

						<div class="row pl-0 mb-3 ml-0 mt-0 title-holder">
							<h5 class="mb-0 bdr-solid-l border-warning heading-bdr"><strong><span class="bg-white pl-3 pr-3">संपर्क करें</span>
							</strong></h5></div>

							<div class="row m-0">
								<div class="col p-0">
									<form action="{{url('contact-info')}}" method="post">
										{{csrf_field()}}
										<div class="form-group">
											<label>Name:</label>
											<input type="text" name="name" class="form-control" id="exampleInputEmail1"  placeholder="Enter name" required="">  </div>

											<div class="form-group">
												<label>E-mail:</label>
												<input type="email" name="email" class="form-control" id="exampleInputEmail1" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Enter email" required="">  </div>

												<div class="form-group">
													<label>Subject:</label>
													<input type="text" name="subject" class="form-control" id="exampleInputEmail1"  placeholder="Enter Subject" required="">  </div>

													<div class="form-group">
														<label>Message:</label>
														<textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="4" required=""></textarea>  </div>


														<button type="submit" class="btn btn-primary btn-sm">Submit</button>
													</form>
												</div>
											</div>

										</div>


										<div class="col-lg-6 col-12 pl-4">

											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7280.702442149869!2d77.35349831188871!3d28.60479669716083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce56d332ef83d%3A0x862ac30ce8d66013!2sExchange4media!5e0!3m2!1sen!2sin!4v1495622403733" width="100%" height="450" frameborder="0" style="border: 2px solid #dcdcdc;" allowfullscreen=""></iframe>

										</div>

									</div>

									<hr class="mt-4 bdr">

									<div class="row">

										<div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center dashed-bdr-r"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid rounded-circle" style="width: 80%;">
										</figure>
										<h6 class="flama mt-2">Annurag Batra <br>
											(Chairman &amp; Editor in Chief)
										</h6>
										<p class="date"><a href="mailto:abatra@exchange4media.com">abatra@exchange4media.com</a><br>
										(0120) 4007700</p>
									</div>

									<div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center dashed-bdr-r"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid rounded-circle" style="width: 80%;">
									</figure>
									<h6 class="flama mt-2">Annurag Batra <br>
										(Chairman &amp; Editor in Chief)
									</h6>
									<p class="date"><a href="mailto:abatra@exchange4media.com">abatra@exchange4media.com</a><br>
									(0120) 4007700</p>
								</div>

								<div class="col-md-4 col-lg-4 col-sm-4 col-12 mt-4 text-center"><figure><img src="http://design.exchange4media.com/e4mdesigner/e4mnew/img/team.jpg" class="img-fluid rounded-circle" style="width: 80%;">
								</figure>
								<h6 class="flama mt-2">Annurag Batra <br>
									(Chairman &amp; Editor in Chief)
								</h6>
								<p class="date"><a href="mailto:abatra@exchange4media.com">abatra@exchange4media.com</a><br>
								(0120) 4007700</p>
							</div>

						</div>

					</div>

				</div><!--left-part-->



				@include('partials.rightsidebar')


			</div><!--center-part-->



		</div>
		<!--middle-body-->


		@endsection 