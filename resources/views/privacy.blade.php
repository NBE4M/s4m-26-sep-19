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
	
		<!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3">
	
		
		<nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
   <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
    <!-- <li class="breadcrumb-item"><a href="#">Library</a></li> -->
    <li class="breadcrumb-item active">privacy policy</li>
  </ol></small>
</nav>
		
		
	
		
		<div class="row no-gutters">
                    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 no-padding term">
    <h5 class="dashed-bdr-b pb-2"><strong>Privacy Policy</strong></h5>
    
    <p>This privacy policy explains our policy regarding the collection, use, disclosure and transfer of your information by Times Internet Limited and/or its subsidiary(ies) and/or affiliate(s) (collectively referred to as the "Company"), which operates various websites and other services including but not limited to delivery of information and content via any mobile or internet connected device or otherwise (collectively the "Services"). This privacy policy forms part and parcel of the Terms of Use for the Services. Capitalized terms which have been used here but are undefined shall have the same meaning as attributed to them in the Terms of Use.</p>
        <p>As we update, improve and expand the Services, this policy may change, so please refer back to it periodically. By accessing the Company website or this Application or otherwise using the Services, you consent to collection, storage, and use of the personal information you provide (including any changes thereto as provided by you) for any of the services that we offer.
</p>  
<p>The Company respects the privacy of the users of the Services and is committed to reasonably protect it in all respects. The information about the user as collected by the Company is: (a) information supplied by users and (b) information automatically tracked while navigation (c) information collected from any other source (collectively referred to as Information).</p>
<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>1. INFORMATION RECEIVED, COLLECTED AND STORED BY THE COMPANY</strong></h4>
<h5 class="flama-font"><strong>A. INFORMATION SUPPLIED BY USERS</strong></h5>
<p><strong>Registration data:</strong><br>
When you register on the website, Application and for the Service, we ask that you provide basic contact Information such as your name, sex, age, address, pin code, contact number, occupation, interests and email address etc. When you register using your other accounts like on Facebook, Twitter, Gmail etc. we shall retrieve Information from such account to continue to interact with you and to continue providing the Services.
</p>
<p>
<strong>Subscription or paid service data:</strong><br>
When you chose any subscription or paid service, we or our payment gateway provider may collect your purchase, address or billing information, including your credit card number and expiration date etc. However when you order using an in-app purchase option, same are handled by such platform providers. The subscriptions or paid Services may be on auto renewal mode unless cancelled. If at any point you do not wish to auto-renew your subscription, you may cancel your subscription before the end of the subscription term.
</p>
<p><strong>Voluntary information:</strong><br>
We may collect additional information at other times, including but not limited to, when you provide feedback, change your content or email preferences, respond to a survey, or communicate with us.
</p>
						<hr class="dashed-bdr-t border-warning">
						
<h5><strong>B. INFORMATION AUTOMATICALLY COLLECTED/ TRACKED WHILE NAVIGATION</strong></h5>
<p><strong>Cookies</strong><br>
To improve the responsiveness of the "Application" for our users, we may use "cookies", or similar electronic tools to collect information to assign each visitor a unique, random number as a User Identification (User ID) to understand the user's individual interests using the identified computer. Unless you voluntarily identify yourself (through registration, for example), we will have no way of knowing who you are, even if we assign a cookie to your computer. The only personal information a cookie can contain is information you supply. A cookie cannot read data off your hard drive. Our advertisers may also assign their own cookies to your browser (if you click on their ads), a process that we do not control. We receive and store certain types of information whenever you interact with us via website, Application or Service though your computer/laptop/netbook or mobile/tablet/pad/handheld device etc.
</p>
<p><strong>Log File Information</strong><br>
We automatically collect limited information about your computer's connection to the Internet, mobile number, including your IP address, when you visit our site, application or service. Your IP address is a number that lets computers attached to the Internet know where to send you data -- such as the pages you view. We automatically receive and log information from your browser, including your IP address, your computer's name, your operating system, browser type and version, CPU speed, and connection speed. We may also collect log information from your device, including your location, IP address, your device's name, device's serial number or unique identification number (e.g.. UDiD on your iOS device), your device operating system, browser type and version, CPU speed, and connection speed etc.</p>
<p><strong>Clear GIFs</strong><br>
We may use "clear GIFs" (Web Beacons) to track the online usage patterns of our users in a anonymous manner, without personally identifying the user. We may also use clear GIFs in HTML-based emails sent to our users to track which emails are opened by recipients. We use this information to inter-alia deliver our web pages to you upon request, to tailor our Site, Application or Service to the interests of our users, to measure traffic within our Application to improve the Application quality, functionality and interactivity and let advertisers know the geographic locations from where our visitors come.
</p>
<p><strong>Information from other Sources:</strong>
We may receive information about you from other sources, add it to our account information and treat it in accordance with this policy. If you provide information to the platform provider or other partner, whom we provide services, your account information and order information may be passed on to us. We may obtain updated contact information from third parties in order to correct our records and fulfil the Services or to communicate with you
</p>
<p><strong>Demographic and purchase information:</strong><br>
We may reference other sources of demographic and other information in order to provide you with more targeted communications and promotions. We use Google Analytics, among others, to track the user behaviour on our website. Google Analytics specifically has been enable to support display advertising towards helping us gain understanding of our users' Demographics and Interests. The reports are anonymous and cannot be associated with any individual personally identifiable information that you may have shared with us. You can opt-out of Google Analytics for Display Advertising and customize Google Display Network ads using the Ads Settings options provided by Google.
</p>
<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>2. LINKS TO THIRD PARTY SITES / AD-SERVERS</strong></h4>
<p>The Application may include links to other websites or applications. Such websites or applications are governed by their respective privacy policies, which are beyond our control. Once you leave our servers (you can tell where you are by checking the URL in the location bar on your browser), use of any information you provide is governed by the privacy policy of the operator of the application, you are visiting. That policy may differ from ours. If you can't find the privacy policy of any of these sites via a link from the application's homepage, you should contact the application owners directly for more information.
</p>
<p>When we present information to our advertisers -- to help them understand our audience and confirm the value of advertising on our websites or Applications -- it is usually in the form of aggregated statistics on traffic to various pages / content within our websites or Applications. We use third-party advertising companies to serve ads when you visit our websites or Applications. These companies may use information (not including your name, address, email address or telephone number or other personally identifiable information) about your visits to this and other websites or application, in order to provide advertisements about goods and services of interest to you.</p>
<p>We do not provide any personally identifiable information to third party websites / advertisers / ad-servers without your consent.</p>
						<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>3. INFORMATION USE BY THE COMPANY</strong></h4>
<p>The Information as supplied by the users enables us to improve the Services and provide you the most user-friendly experience. In some cases/provision of certain service(s) or utility(ies), we may require your contact address as well. All required information is service dependent and the Company may use the above said user Information to, maintain, protect, and improve the Services (including advertising on the "Application") and for developing new services. We may also use your email address or other personally identifiable information to send commercial or marketing messages without your consent [with an option to subscribe / unsubscribe (where feasible)]. We may, however, use your email address without further consent for non-marketing or administrative purposes (such as notifying you of major changes, for customer service purposes, billing, etc.).</p>
<p>Any personally identifiable information provided by you will not be considered as sensitive if it is freely available and / or accessible in the public domain like any comments, messages, blogs, scribbles available on social platforms like facebook, twitter etc.
</p>
<p>Any posted/uploaded/conveyed/communicated by users on the public sections of the "Application" becomes published content and is not considered personally identifiable information subject to this Privacy Policy.</p>
<p>In case you choose to decline to submit personally identifiable information on the Application, we may not be able to provide certain services on the Application to you. We will make reasonable efforts to notify you of the same at the time of opening your account. In any case, we will not be liable and or responsible for the denial of certain services to you for lack of you providing the necessary personal information.</p>
<p>When you register with the Application or Services, we contact you from time to time about updating of your personal information to provide the users such features that we believe may benefit / interest you.</p>
						<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>4. INFORMATION SHARING</strong></h4>
<p>The Company shares your information with any third party without obtaining the prior consent of the User in the following limited circumstances:</p>
<p>a)When it is requested or required by law or by any court or governmental agency or authority to disclose, for the purpose of verification of identity, or for the prevention, detection, investigation including cyber incidents, or for prosecution and punishment of offences. These disclosures are made in good faith and belief that such disclosure is reasonably necessary for enforcing these Terms or for complying with the applicable laws and regulations.</p>
<p>b) The Company proposes to share such information within its group companies and officers and employees of such group companies for the purpose of processing personal information on its behalf. We also ensure that these recipients of such information agree to process such information based on our instructions and in compliance with this Privacy Policy and any other appropriate confidentiality and security measures.</p>
<p>c) The Company may present information to our advertisers - to help them understand our audience and confirm the value of advertising on our websites or Applications – however it is usually in the form of aggregated statistics on traffic to various pages within our site.</p>
<p>d) The Company may share your information regarding your activities on websites or Applications with third party social websites to populate your social wall that is visible to other people however you will have an option to set your privacy settings, where you can decide what you would like to share or not to share with others.</p>
<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>5. ACCESSING AND UPDATING PERSONAL INFORMATION</strong></h4>
<p>When you use the Services Site (or any of its sub sites), we make good faith efforts to provide you, as and when requested by you, with access to your personal information and shall further ensure that any personal information or sensitive personal data or information found to be inaccurate or deficient shall be corrected or amended as feasible, subject to any requirement for such personal information or sensitive personal data or information to be retained by law or for legitimate business purposes. We ask individual users to identify themselves and the information requested to be accessed, corrected or removed before processing such requests, and we may decline to process requests that are unreasonably repetitive or systematic, require disproportionate technical effort, jeopardize the privacy of others, or would be extremely impractical (for instance, requests concerning information residing on backup tapes), or for which access is not otherwise required. In any case, where we provide information access and correction, we perform this service free of charge, except if doing so would require a disproportionate effort. Because of the way we maintain certain services, after you delete your information, residual copies may take a period of time before they are deleted from our active servers and may remain in our backup systems.</p>
						<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>6. INFORMATION SECURITY</strong></h4>
<p>We take appropriate security measures to protect against unauthorized access to or unauthorized alteration, disclosure or destruction of data. These include internal reviews of our data collection, storage and processing practices and security measures, including appropriate encryption and physical security measures to guard against unauthorized access to systems where we store personal data. All information gathered on TIL is securely stored within the Company controlled database. The database is stored on servers secured behind a firewall; access to the servers is password-protected and is strictly limited. However, as effective as our security measures are, no security system is impenetrable. We cannot guarantee the security of our database, nor can we guarantee that information you supply will not be intercepted while being transmitted to us over the Internet. And, of course, any information you include in a posting to the discussion areas is available to anyone with Internet access.</p>
<p>We use third-party advertising companies to serve ads when you visit or use our website, mobile application or services. These companies may use information (not including your name, address, email address or telephone number) about your visits or use to particular website, mobile application or services, in order to provide advertisements about goods and services of interest to you.</p>
						<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>7. UPDATES / CHANGES</strong></h4>
<p>The internet is an ever-evolving medium. We may alter our privacy policy from time to time to incorporate necessary changes in technology, applicable law or any other variant. In any case, we reserve the right to change (at any point of time) the terms of this Privacy Policy or the Terms of Use. Any changes we make will be effective immediately on notice, which we may give by posting the new policy on the "Application". Your use of the Application or Services after such notice will be deemed acceptance of such changes. We may also make reasonable efforts to inform you via electronic mail. In any case, you are advised to review this Privacy Policy periodically on the "Application") to ensure that you are aware of the latest version.</p>
						<hr class="bdr-solid-t border-dark">
<h4 class="text-warning"><strong>8. QUESTIONS / GRIEVANCE REDRESSAL</strong></h4>
<p>Redressal Mechanism: Any complaints, abuse or concerns with regards to the processing of information provided by you or breach of these terms shall be immediately informed to the designated Grievance Officer as mentioned below via in writing or through email signed with the electronic signature to grievance@timesinternet.in or ("Grievance Officer")</p>
<p>Grievance Officer (Samachar4Media)<br>
Adsert Web Solutions Pvt Ltd <br>
B-20, First Floor, Sector-57<br>
Noida, Uttar Pradesh 201301, India<br>
Ph:&nbsp;0120-40077000</p>
<p>We request you to please provide the following information in your complaint:-</p>
<ol>
<li> Identification of the information provided by you;</li>
<li> Clear statement as to whether the information is personal information or sensitive personal information;</li>
<li> Your address, telephone number or e-mail address;</li>
<li> A statement that you have a good-faith belief that the information has been processed incorrectly or disclosed without authorization, as the case may be;</li>
<li> A statement, under penalty of perjury, that the information in the notice is accurate, and that the information being complained about belongs to you;</li>
<li> You may also contact us in case you have any questions / suggestions about the Privacy Policy using the contact information mentioned above.</li>
</ol>
<p>The company shall not be responsible for any communication, if addressed, to any non-designated person in this regard.</p>





    </div>
                    
                                    </div>
	
	
	
		
		</div><!--left-part-->
		
	
@include('partials.rightsidebar')
		
	
		</div><!--center-part-->
		

	
	</div>
	<!--middle-body-->

@endsection      