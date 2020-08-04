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
    <li class="breadcrumb-item active">cookies policy</li>
  </ol></small>
</nav>
		
		
	
		
		<div class="row no-gutters">
                    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 no-padding term">
   <h4 class="flama-font mb-1 mt-2">HOW DOES Samachar4Media USE COOKIES?</h4>
    
    <p>A cookie is a small piece of text that allows a website to recognize your device and maintain a consistent, cohesive experience throughout multiple sessions. If you use the Samachar4Media Platform, both Samachar4Media and third parties will use cookies to track and monitor some of your activities on and off the Samachar4Media Platform, and store and access some data about you, your browsing history, and your usage of the Samachar4Media Network.</p>
        <p>
This policy describes how both Samachar4Media and other third parties use cookies both within and without the Samachar4Media Platform and how you can exercise a greater degree of control over cookies. Please keep in mind that this may alter your experience with our platform, and may limit certain features (including being logged in as a user).</p>

<p><strong>General Browsing:</strong>&nbsp;We use cookies that are important for certain technical features of our website, like logging into user accounts and implementing fixes and improvements to our platform.</p>
<p><strong>These cookies:</strong></p>
<ul>
<li>Enable behavior in our Products and/or Services that is tailored to the activity or preferences of a person visiting our properties</li>
<li>Allow users to opt out of certain types of modeling, tailoring, or personalization in our products</li>
<li>Collect information on our users’ preferences in order to create more useful products</li>
<li>Maintain the regular business operations of our Advertising and Marketing departments (such as one-time pop-ups or “hero” displays when first visiting a site and to collect impressions and click data)</li>
<li>Help to diagnose and correct downtime, bugs, and errors in our code to ensure that our products are operating efficiently</li>
</ul>
<p><strong>Samachar4Media Main Website:</strong>&nbsp;We use cookies that support and enhance our public content platform by enabling important functionality. Such activity includes tracking and attributing content reads, push notifications and logins.
</p>
<p><strong>These cookies:</strong></p>
<ul>
<li>Validate the authenticity of persons attempting to gain access to a specific user account</li>
<li>Enable the core platform of content to show and hide specific elements.</li>
<li>Identify individual users to attribute activities and actions.</li>
</ul>
<p><strong>Advertising:</strong>&nbsp;We use cookies to enable advertising with our third-party Partners, which in turn allows us to provide many of our services free of charge.</p>
<p><strong>These cookies:</strong></p>
<p>Customize the ad experience for our users, including tailoring job and display ads to the technologies a person has previously looked at, the communities a person has visited, and the job ads a person has already seen</p>
<p>Allow direct communication between a 3rd party partner who hosts a promotional event with us, and users who have opted into the promotion</p>
<p>Allow us to track when a <strong>Samachar4Media</strong> user sees or clicks on an ad or later visits a third-party website or purchases a product on a third-party website</p>
<p>Collect impressions and click data for internal reporting and product optimization</p>
<p><strong>Analytics:</strong>&nbsp;We use cookies to compile usage activity in order to better cater our Products and Services offerings to you, and to third parties. We DO NOT share identifiable “raw” data with our clients or any third parties, however we do make high-level decisions based on aggregated data about your usage of our Products and Services.
</p>
<p><strong>These cookies:</strong></p>
<ul>
<li>Monitor site traffic and behavior flows of users</li>
<li>Measure the effectiveness of on-site products</li>
<li>Measure the effectiveness of off-site marketing campaigns and tactics</li>
</ul>
<h4 class="flama-font">WHAT INFORMATION IS COLLECTED ON ME VIA COOKIES?</h4>    
<p>In general, we collect most data from you via form submission. However, there are cases when visiting our site and/or using our platforms in which we may receive certain information through the use of cookies. This data will generally not include personally identifying information about you.</p>
<h4 class="flama-font">HOW DO I RESTRICT COOKIES?</h4>
<p>If you don’t want <strong>Samachar4Media</strong> to use cookies when you visit the <strong>Samachar4Media</strong> network of sites, you can opt-out of all cookies from your browser. If you opt-out of cookies, you might face issues w.r.t authentication on our platform and the functionality like bookmarks, read late, recommended content and your ability to write on <strong>Samachar4Media</strong> might not be as intuitive as it should be.</p>
<p>While setting options may vary from browser to browser, you can generally choose to reject some or all cookies, or instead to receive a notification when a cookie is being placed on your device. For more information, please refer to the user help information for your browser of choice. Please keep in mind that cookies may be required for certain functionalities, and by blocking these cookies, you may limit your access to certain parts or features of our sites and platforms.</p>
<p>Finally, while cookies are set for varying durations on your device, you can manually delete them at any time. However, deleting cookies will not prevent the site from setting further cookies on your device unless you adjust the settings discussed above. </p>
<h4 class="flama-font">CONTACT US</h4>
<p>If you have any questions, comments, or concerns regarding this Cookies Policy, please contact <strong>Samachar4Media</strong> at:</p>
<p><a href="mailto:contact@Samachar4Media.com">contact@Samachar4Media.com</a></p>






    </div>
                    
                                    </div>
	
	
	
		</div>
		</div><!--left-part-->
		
	
@include('partials.rightsidebar')
		
	
		</div><!--center-part-->
		

	
	</div>
	<!--middle-body-->

@endsection      