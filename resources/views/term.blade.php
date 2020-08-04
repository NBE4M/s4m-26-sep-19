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
    <li class="breadcrumb-item active">terms of use</li>
  </ol></small>
</nav>
		
		
	
		
		<div class="row no-gutters">
                    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 no-padding term">
    <h5 class="dashed-bdr-b pb-2"><strong>TERMS OF USE</strong></h5>
    
    <p>Welcome to Samachar4Media, its mobile site  (the “Site”) owned, managed and operated by Adsert Web Solutions Pvt Ltd (hereinafter referred to as the “Company”, “we” or “our”, which expression shall unless the same be repugnant to the context or meaning thereof be deemed to mean and include its affiliates, successors in business and assigns).</p>
        
<!-- <hr class="bdr-solid-t border-dark"> -->
<!-- <h4 class="text-warning"><strong>ACCEPTANCE OF TERMS OF USE</strong></h4> -->
<h5 class="flama-font"><strong>ACCEPTANCE OF TERMS OF USE</strong></h5>
<p>
	<!-- <strong>Registration data:</strong><br> -->
When you register on the website, Application and for the Service, we ask that you provide basic contact Information such as your name, sex, age, address, pin code, contact number, occupation, interests and email address etc. When you register using your other accounts like on Facebook, Twitter, Gmail etc. we shall retrieve Information from such account to continue to interact with you and to continue providing the Services.
</p>
<p>
<!-- <strong>Subscription or paid service data:</strong><br> -->
“User”, “you” or “your”:  means any person, who is accessing, using the Site, in any manner whatsoever, and is of 18 years of age or older, capable to enter into a legally binding agreement under the laws of India.
</p>
<p>
	<!-- <strong>Voluntary information:</strong><br> -->
By accessing the Site or Service, you agree to be bound by these Terms. You hereby represent and warrant to the Company that you are at least eighteen (18) years of age or above and are capable of entering, performing and adhering to these Terms and that you agree to be bound by the following terms and conditions. While individuals under the age of 18 may access and use the site, they shall do so only with the involvement & guidance of their parents and / or legal guardians.  You agree to register prior to uploading any content and / or comment and any other use or Services of this Site and provide your details including but not limited to complete name, age, email address, residential address, contact number.
</p>
<p>
	The Company reserves the right, at its discretion, to change, modify, add, or remove portions of these Terms at any time by posting the amended Terms. Please check these Terms periodically for changes. Your continued use of the site or Services after the posting of changes constitutes your binding acceptance of such changes. In addition, when using any particular services, you may be subject to any posted guidelines, rules, product requirements or sometimes additional terms applicable to such services. All such guidelines, rules, product requirements or sometimes additional terms are hereby incorporated by reference into the Terms.
</p>						
<p>
	YOUR ACCESS OR USE OF THE SITE OR SERVICE SHALL MEAN THAT YOU HAVE READ, UNDERSTAND AND AGREE TO BE BOUND BY THE TERMS. BY ACCESSING OR USING ANY WEBSITE OR SERVICES YOU ALSO REPRESENT THAT YOU HAVE THE LEGAL AUTHORITY AS PER APPLICABLE LAW (INCLUDING BUT NOT LIMITED TO AGE REQUIREMENT) TO ACCEPT THE TERMS ON BEHALF OF YOURSELF AND/OR ANY OTHER PERSON YOU REPRESENT IN CONNECTION WITH YOUR USE OF THE SITE OR SERVICES. IF YOU DO NOT AGREE TO THE TERMS, YOU ARE NOT AUTHORIZED TO USE THE SITE OR SERVICES.
</p>						
<h5><strong>CONTENT OWNERSHIP AND LIMITED LICENSE</strong></h5>
<p>
	<strong>Company Content</strong><br>
means Company’s content, including but not limited to, Company trademarks and logos made available through the Site and Services, excluding Third Party Content and User Submissions.
</p>
<p><strong>Third Party Content</strong><br>
You may be able to access, review, display or use third party services, resources, content or information via the Site or the Services.</p>
<p><strong>User Submissions</strong><br>
“means the text, data, graphics, images, photos, video or audiovisual content, hypertext links and any other content that the Company allows its users to uploads, posts, flips, compiles or otherwise provided to Company via the Site and Services, as applicable.
</p>
<p><strong>Ownership:</strong>
The Site, Services and the Company Content are protected by copyright, trademark and other applicable laws. Except as expressly provided in these Terms, Company and its licensors exclusively own all right, title and interest in and to the Site, Services, and the Company Content, including all associated intellectual property rights. You may not remove, alter or obscure any copyright, trademark, service mark or other proprietary rights notices incorporated in or accompanying the Site, Services or Company Content. Company claims no ownership interest in any Third-Party Content and expressly disclaims any liability concerning those materials.
</p>
<p><strong>Limited License:</strong><br>
Subject to your compliance with the Terms herein, the Company hereby grants you a personal, limited, non-exclusive, non-transferable, freely revocable license to use the Services for the personal and non-commercial use only. Except for the foregoing limited license, no right, title or interest shall be transferred to you. Content on the Site and/or the Services is provided to you “AS IS” for your information and personal use only and may not be used, copied, reproduced, distributed, transmitted, broadcast, displayed, sold, licensed, or otherwise exploited for any other purposes whatsoever without the prior written consent of the respective owners. We reserve all rights not expressly granted in and to the Site and/or the Services and the Content. These Terms do not authorize you to, and you may not, reproduce, distribute, publicly display, publicly perform, communicate to the public, make available, create derivative works of or otherwise use or exploit any Third-Party Content or User Submissions in violation of applicable copyright law. Any unauthorized use of the Contents or the Services will result in termination of the limited license granted by the Company and cancellation of your membership. Use of Site or the Services for any unauthorized purpose may result in severe civil and criminal penalties. The Company does not promote, foster or condone the copying of Content, or any other infringing activity and the owners of Third-Party Content or User Submissions may have the right to seek damages against you for any such violation.
</p>
<!-- <hr class="bdr-solid-t border-dark"> -->
<h4 class="text-warning"><strong>Interactions between Users</strong></h4>
<p>You are solely responsible for your interactions (including any disputes) with other users. You understand that Company does not in any way screen Company users. You are solely responsible for, and will exercise caution, discretion, common sense and judgment in, using the Site and Services and disclosing personal information to other Company users. You agree to take reasonable precautions in all interactions with other Company users, particularly if you decide to communicate with Company user offline or meet them in person. Your use of the Site, Services, Company Content, and any other content made available through the Site or Services is at your sole risk and discretion, and Company hereby disclaims any and all liability to you or any third party relating thereto. Company reserves the right to contact Company users, in compliance with applicable law, in order to evaluate compliance with the rules and policies in this Terms You will cooperate fully with Company to investigate any suspected unlawful, fraudulent or improper activity via the Services.
</p>
<p>By making available any User Submissions through the Site and Services, you hereby grant to Company and its users a worldwide, non-exclusive, perpetual, irrevocable, transferable, assignable, royalty-free license, with the right to sublicense, to use, copy, adapt, modify, distribute, publicly display, publicly perform, transmit, stream, broadcast, make available, communicate to the public and otherwise use and exploit such User Submissions through or by means of the Site and the Services and/or to incorporate it in other works in any form, media, or technology now known or later developed throughout the world.  Company does not claim any ownership rights in any such User Submissions and nothing in these Terms will be deemed to restrict any rights that you may have to use any such User Submissions. You hereby acknowledge and agree that Company shall not be liable for any Uses of your User Submissions by any third party that had access to your User Submissions during the period in which your User Submissions was available on or through the Services. You acknowledge and agree that Company reserves the right to not to publish, display the User Submissions or modify, amend or delete any User Submissions on the receipt of any complaint, that the User Submissions are infringing or in violation of any applicable laws. You acknowledge and agree that you are solely responsible for all User Submissions that you make available through the Site or Services. Accordingly, you represent and warrant that: (a) you either are the sole and exclusive owner of all User Submissions that you make available through the Site or Services or you have all rights, licenses, consents and releases that are necessary to grant to Company the rights in such User Submissions, as contemplated under these Terms; (b) neither the User Submissions nor your accessing, posting, submission or transmittal of the User Submissions or Company’s use of the User Submissions (or any portion thereof) on, through or by means of the Site and the Services or any other permitted use will infringe, misappropriate or violate a third party’s patent, copyright, trademark, trade secret, moral rights or other intellectual property rights, or rights of publicity or privacy, or result in the violation of any applicable law or regulation; and (c) no payments of any kind shall be due to any third party, whether a copyright owner or an agent thereof, for any use made of the User Submissions (or any portion thereof) on, through or by means of the Site and the Services.</p>
<p>By using the Site or the Services, you acknowledge the sole responsibility for and assume all risk arising from your access to, use of or reliance upon any such Third-Party Content, or User Submissions and Company disclaims any liability that you may incur arising from your access to, use of or reliance upon such Third-Party Content or User Submissions. You acknowledge and agree that Company: (a) is not responsible for the availability or accuracy of such Third Party Content or User Submissions; (b) has no liability to you or any third party for any harm, injuries or losses suffered as a result of your access to, reliance on or use of such Third Party Content or User Submissions; (c) does not undertake or assume any duty to monitor for inappropriate or unlawful content on third party websites or User Submissions; and (d) does not make any promises to remove Third Party Content from being accessed through the Site or the Services.</p>
						<!-- <hr class="bdr-solid-t border-dark"> -->
<h4 class="text-warning"><strong>THE SERVICE REGISTRATION AND ACCESS TO USE</strong></h4>
<h5 class="flama-font"><strong>Registration</strong></h5>
<p>To register for the Services, you may be required to open an account by completing the registration process (i.e. by providing us with current, complete and accurate information as prompted by the applicable registration form). You will also choose a password and a user name. You are entirely responsible for maintaining the confidentiality of your password and account. In particular, as a parent or legal guardian, you acknowledge and assume sole responsibility to ensure that content which is meant for mature audiences (i.e, above the age of majority) is not accessed by children. Hence, you may not share your log in credentials with your children. You expressly agree to absolve the Company of any responsibility / liability in this regard.</p>

						
<h4 class="text-warning"><strong>LINKS TO OTHER SITES</strong></h4>
<p>The Site or the Services may contain the links or pointers to other websites but you should not infer or assume that the Company operates, controls, or is otherwise connected with these other websites. When you click on a link within the Site, the Company may not warn you that you have left the Site and are subject to the terms and conditions (including privacy policies) of another website. Please be careful to read the terms of use and privacy policy of any other website before you provide any confidential information or engage in any transactions. You should not rely on these Terms to govern your use of another website.</p>
<p>The Company is not responsible for the content or practices of any other website even if it links to the Site and even if the website is operated by a company affiliated or otherwise connected with the Company. You acknowledge and agree that the Company is not responsible or liable to you for any content or other materials hosted and served from any website other than the Site.</p>


<h4 class="text-warning"><strong>ADVERTISING MATERIAL</strong></h4>
<p>Part of the Site or the Services may contain advertising information or promotion material or other material submitted to the Company by third parties. Responsibility for ensuring that material submitted for inclusion on the Site complies with applicable international and national law is exclusively on the party providing the information/material. Your correspondence or business dealings with, or participation in promotions of advertisers including payment and delivery of related goods or services, and any other terms, conditions, warranties or representations associated with such dealings, are solely between you and such advertiser. Before relying on any advertising material, you should independently verify its relevance for your purpose, and should obtain appropriate professional advice. The Company shall not be responsible nor liable for any loss or claim that you may have against an advertiser or any consequential damages arising on account of your relying on the contents of the advertisement.</p>
						
<h4 class="text-warning"><strong>COLLECTION AND USE OF PERSONAL INFORMATION</strong></h4>
<p>For information about the Company´s policies and practices regarding the collection and use of your personally identifiable information, please read the Privacy Policy as available on the Site. The Privacy Policy is incorporated by reference and made part of these Terms. Thus, by agreeing to these Terms, you agree that your presence on the Site and use of the Services are governed by the Company’s Privacy Policy in effect at the time of your use. The Company reserves the right to disclose any information that is required to be shared, disclosed or made available to any governmental, administrative, regulatory or judicial authority under any law or regulation applicable to the Company. The Company can further disclose your name, street address, city, state, zip code, country, phone number, email, as it in its sole discretion believes necessary or appropriate in connection with an investigation of fraud, intellectual property infringement, piracy, or other unlawful activity. Company may also share certain filtered information, i.e. email id or any other relevant information, to Company's third-party business partners who may contact you to enable you to have a better experience on the Site or to avail certain benefits specially made for you. Company may, if you so choose, send direct mailers to you at the address given by you. You have the option to 'opt-out' of this direct mailer by way of links provided at the bottom of each mailer. Company respects your privacy and if you choose to not receive such mailers, Company will take all steps to remove you from the list.</p>

						
<h4 class="text-warning"><strong>YOUR OBLIGATIONS</strong></h4>
<p>You hereby agree and assure the Company that the Site and/or the Services shall be used for lawful purposes only and that you will not violate laws, regulations, ordinances or other such requirements of any applicable Central, State or local government or any other international laws. You specifically agree to comply with the requirements of the Information Technology Act, 2000 as also rules, regulations, guidelines, bye laws and notifications made thereunder, while on the Site. You further concur that you shall not:</p>
<ol>
<li> use the Site or the Services in any manner that could damage, disable, overburden, or impair and not to undertake any action which is harmful or potentially harmful to any the Company´s server, or the network(s), computer systems / resource connected to any the Company server, or interfere with any other party´s use and enjoyment of the Site or the Services;</li>
<li> obtain or attempt to obtain any materials or information through any means not intentionally made available through the Site/Services;</li>
<li> perform any activity which is likely to cause such harm;</li>
<li> carry out any "denial of service" (DoS, DDoS) or any other harmful attacks on Site or internet service or;</li>
<li> use the Site or the Services for illegal or unlawful purposes;</li>
<li> disrupt, place unreasonable burdens or excessive loads on, interfere with or attempt to make or attempt any unauthorized access to Site or any the Company website or the website of any the Company´s customer;</li>
<li>forge headers or otherwise manipulate identifiers in order to disguise the origin of any content transmitted through the Site or the Services;</li>
<li>attempt to gain unauthorized access to the Services, other accounts and computer systems through hacking, password mining or any other means. You shall not obtain or attempt to obtain any materials or information through any means not intentionally made available through the Site or the Services;</li>
<li>incorporate the Site or Services into or retransmit via, any hardware or software application or make it available via frames or in-line links unless expressly permitted by the Company in writing;</li>
<li>create, recreate, distribute or advertise an index of any significant portion of the Site or Services unless authorized by the Company;</li>
<li>use or launch any "robots", "spiders", "offline readers" etc. or any other automated system, that accesses the Site or the Services in a manner that sends numerous automated requests to the Site´s servers in a given period of time, which a human cannot reasonably send in the same period by using conventional web browsing application or tool(s) for similar purposes;</li>
<li>Send or post any unsolicited or unauthorized advertising, promotional materials, email, junk mail, spam, chain letters or other form of solicitation like solicit login information or access an account belonging to someone else;</li>
<li>Use the Site, Services or Company Content for any commercial purpose or the benefit of any third party or in any manner not permitted by these Terms of Use;</li>
<li>Impersonate or misrepresent your affiliation with any person or entity;</li>
<li>Encourage or enable any other individual to do any of the foregoing.</li>
</ol>
<p>In addition, you are strictly prohibited from creating derivative works or materials that otherwise are derived from or based, on the Content in any way, including montages, mash-ups and similar videos, wallpaper, desktop themes, greeting cards, and merchandise, unless it is expressly permitted by the Company in writing. This prohibition applies even if you intend to give away the derivative materials free of charge.</p>
<p>The Site may permit you to post user submissions including but not limited to reviews of Content available through the Services, comments on such Content etc. You understand that these User Submissions, once posted by you, are visible to all members since it is a public forum.</p>
<p>More specifically, when you review / rate any Content available on the Services (as per functionality made available on the Site), you give the Company express rights and consent to display your rating / review in relation to the relevant Content on the Site, including making it available to other members for viewing. If you do not want your User Submissions / reviews / ratings to be shared in a public forum, do not use these features.</p>
<p>These features may change without notice to you and the degrees of associated information sharing and functionality may also change without notice.</p>
<p>The Company is free to use any comments, information, ideas, concepts, reviews, or techniques or any other material contained in any communication you may send to us ("User Feedback"), including responses to questionnaires or through postings to the Services / the Site and User Submissions, without further compensation, acknowledgement or payment to you for any purpose whatsoever including, but not limited to, developing, manufacturing and marketing products and creating, modifying or improving the Services. By posting / submitting any User Feedback / User Submission on the Site, you grant the Company a perpetual, worldwide, non-exclusive, royalty-free irrevocable, sub-licensable license and right in such User Feedback / User Submission to the Company, including the right to display, use, reproduce or modify the User Feedback / User Submission in any media, software or technology of any kind now existing or developed in the future.</p>
<p>Operators of public search engines have the permission to use functionalities like spiders to copy materials from the Site for the sole purpose of creating publicly available searchable indices of the materials, but not caches or archives of such materials. We reserve the right to revoke these exceptions either generally or in specific cases, in our sole discretion. You agree not to collect or harvest any personally identifiable information, including account names, from the Site, nor to use the communication systems provided by the Site for any commercial solicitation purposes. You agree not to solicit, for commercial purposes, any users of the Site with respect to its User Submissions.</p>
<p>You shall be financially responsible for your use of the Services (as well as for use of your account by others, including without limitation minors living with you). You undertake to supervise and be responsible for all usage of minors and access of the Site under your name or account and absolve the Company from any liability on this account. You also warrant that all information supplied by you or members of your family for using the Services and accessing the Site, including without limitation your name, email address, street address, telephone number, mobile number, credit card number is correct and accurate. Failure to provide accurate information may subject you to civil and criminal penalties.</p>
<p>You shall be responsible for obtaining and maintaining any equipment or ancillary services needed to connect to, access the Site or otherwise use the Services, including, without limitation, modems, hardware, software, and long distance or local telephone service. You shall be responsible for ensuring that such equipment or ancillary services are compatible with the Services.</p>
<p>You agree that the Company may directly or through third party service providers send information to you about the various services offered by the Company from time to time.</p>
<p>You agree that Company will have the right to investigate and take all appropriate legal action to prevent, stop or deter violations of any of the above, including infringement of intellectual property rights and Site and Services security issues. Company may involve and cooperate with law enforcement authorities in prosecuting users who violate these Terms of Use or the rights of any third party.</p>
<p>You acknowledge that Company has no obligation to monitor your access to or use of the Site, Services or Company Content or to review or edit any User Submissions or Third-Party Materials, but has the right to do so for the purpose of operating the Site and Services, to ensure your compliance with these Terms of Use, or to comply with applicable law or the order or requirement of a court, administrative agency or other governmental body. Company reserves the right, at any time and without prior notice, to remove or disable access to any Company Content, Third Party Materials, and any User Submissions, that Company, in its sole discretion, considers to be in violation of these Terms or otherwise harmful to the Site or Services.</p>




						
<h4 class="text-warning"><strong>PROHIBITED ACTIVITIES</strong></h4>
<p>You agree not to host, display, upload, modify, publish, transmit, update or share any information or User Submissions which</p>

<ol>
<li> belongs to another person and to which the User does not have any right to;</li>
<li> is grossly harmful, harassing, blasphemous defamatory, obscene, pornographic, pedophilic, libelous, invasive of another´s privacy, hateful, or racially, ethnically objectionable, disparaging, relating or encouraging money laundering or gambling, or otherwise unlawful in any manner whatever;</li>
<li> harm minors in any way;</li>
<li> infringes any patent, trademark, copyright or other proprietary rights;</li>
<li> violates any law for the time being in force;</li>
<li> deceives or misleads the addressee about the origin of such messages or communicates any information which is grossly offensive or menacing in nature;</li>
<li>contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer resource;</li>
<li>threatens the unity, integrity, defense, security or sovereignty of India, friendly relations with foreign states, or public order or causes incitement to the commission of any cognizable offence or prevents investigation of any offence or is insulting any other nation;</li>
<li>contain misleading information regarding the origin of the Content; or</li>
<li>otherwise contains objectionable content.</li>
</ol>
<p>You understand and agree that the Company may, but is not obligated to, review the User Submissions and may delete or remove it (without notice) in its sole and absolute discretion, for any reason or without assigning any reason.</p>
<p>If you are found to be in non-compliance with the laws and regulations, these terms, or the privacy policy of the Site,   the Company shall have the right to immediately terminate/block your access and usage of  the Site and  the Company shall have the right to immediately remove any non-compliant Content and or comment, uploaded by you and shall further have the right to take recourse to such  remedies as would be available to the Company under the applicable laws.</p>

<h4 class="text-warning"><strong>TERMINATION OF ACCOUNT, SUSPENSION OR DISCONTINUATION OF THE SERVICE</strong></h4>
<p>The Company reserves the right to change, suspend, or discontinue temporarily or permanently, some or all of the Services (including the Content and the devices through which the Services are accessed), with respect to any or all users, at any time without notice. You acknowledge that the Company may do so in its sole discretion. You also agree that the Company will not be liable to you for any modification, suspension, or discontinuance of the Services, although if you are a paid subscriber and the Company suspends or discontinues the Services, the Company may, in its sole discretion, provide you with a credit, refund, discount or other form of consideration (for example, the Company may credit additional days of service to your account). However, if the Company terminates your account or suspends or discontinues your access to the Services due to your violation of these Terms, then you will not be eligible for any such credit, refund, discount or other consideration.</p>

<h4 class="text-warning"><strong>DISCLAIMER OF WARRANTIES AND LIABILITY</strong></h4>
<p>You understand and agree that the Company provides the Services on ´as-is´ ´with all faults´ and ´as available´ basis. You agree that use of the Site or the Services is at your risk. All warranties including without limitation, the implied warranties of merchantability, fitness for a particular purpose, for the title and non-infringement are disclaimed and excluded.</p>
<p>No representations, warranties or guarantees whatsoever are made by the Company as to the (a) accuracy, adequacy, reliability, completeness, suitability or applicability of the information to a particular situation; (b) that the service will be uninterrupted, timely, secure, or error-free; (c) the quality of any services, content, information, or other material on the Site will meet your expectations or requirements; (d) any errors in the Site will be corrected; (e) warranties against infringement of any third party intellectual property or proprietary rights; or (f) other warranties relating to performance, non-performance, or other acts or omissions of the Company, its officers, directors, employees, affiliates, agents, licensors, or suppliers.</p>
<p>The Company does not warrant that any of the software used and or licensed in connection with the Services will be compatible with other third-party software or devices nor does it warrant that operation of the Services and the associated software will not damage or disrupt other software or hardware.</p>
<p>The Company, its affiliates, successors, and assigns, and each of their respective investors, directors, officers, employees, agents, and suppliers (including distributors and content licensors) shall not be liable, at any time for any, direct, indirect, punitive, incidental, special, consequential, damages arising out of or in any way connected with the use of Site or the Services, whether based in contract, tort, strict liability, or other theory, even if the Company have been advised of the possibility of damages.</p>
<p>In the event any exclusion contained herein be held to be invalid for any reason and the Company or any of its affiliate entities, officers, directors or employees become liable for loss or damage, then, any such liability of the Company or any of its affiliate entities, officers, directors or employees shall be limited to not exceeding subscription charges paid by you in the month preceding the date of your claim for the particular subscription in question chosen by you.</p>

<h4 class="flama-font">INDEMNIFICATION</h4>
<p>You agree to indemnify, defend and hold harmless, the Company, its affiliates, successors, and assigns, and each of their respective investors, directors, officers, employees, agents, and suppliers (including distributors and content licensors) from and against any losses, claims, damages, liabilities, including legal fees and expenses, arising out of:</p>
<ul>
<li>any claim due to or arising out of your violation of these Terms, including but not limited to a claim arising out of a breach of your representations or warranties made hereunder;</li>
<li>your use or misuse of or access to the Site or the Services;</li>
<li>your violation of any law, regulation or third party right, including without limitation any copyright, property, or privacy right; or</li>
<li>any claim that you have caused damage to a third party.</li>
</ul>
<p>The Company reserves the right, at its own expense, to employ separate counsel and assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and you agree to cooperate with the Company´s defense of these claims.</p>
<p><strong>Notice of Copyright Infringement:</strong> &nbsp;Our policy is to comply with all Intellectual Property Laws and to act expeditiously upon receiving any notice of claimed infringement. If you believe that any work has been reproduced on the Site in a manner that constitutes copyright infringement, please provide a notice of copyright infringement containing all of the following information:</p>

<ul>
<li>A physical or electronic signature of a person authorized to act on behalf of the copyright owner for the purposes of the complaint.</li>
<li>Identification of the copyrighted work claimed to have been infringed.</li>
<li>Identification of the material on our Site that is claimed to be infringing or to be the subject of infringing activity.</li>
<li>The address, telephone number or e-mail address of the complaining party.</li>
<li>A statement that the complaining party has a good-faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent or the law.</li>
<li>A statement, under penalty of perjury, that the information in the notice of copyright infringement is accurate, and that the complaining party is authorized to act on behalf of the owner of the right that is allegedly infringed.</li>
</ul>
<h4 class="flama-font">GENERAL TERMS</h4>
<h5 class="flama-font">Relationship</h5>
<p>None of the provisions of the Terms shall be deemed to constitute a partnership or agency between you and the Company and you shall have no authority to bind the Company in any manner, whatsoever. This agreement is solely for your and the Company’s benefit and not for the benefit of any other person, except for permitted successors and assigns under this Agreement.</p>


<h5 class="flama-font">Assignment</h5>
<p>You may not transfer to anyone else, either temporarily or permanently, any rights to use the Services or any part of the Services. Any attempt by you to do so is void. The Company may assign, transfer, delegate and/or grant all or any part of its rights, privileges and properties hereunder to any person or entity.</p>
<h5 class="flama-font">Force Majeure</h5>
<p>Neither Party shall have any liability for any interruption or delay, to access the Site due to Force Majeure Event. For the purposes of this clause, ´Force Majeure Event´ means any event or circumstance or combination of events and circumstances which is reasonably beyond the control of the party affected thereby and which causes or results in default or delay in performance by such affected party of any of its obligations under this agreement and includes an act of God, war, hostilities, civil commotion, strikes, lockouts and other industrial disputes.</p>
<h5 class="flama-font">Applicable Law</h5>
<p>These Terms are governed by and construed in accordance with, the laws of India without giving effect to principles of conflict of law. In the event of any dispute or claim by you against the Company, you agree to submit to the exclusive jurisdiction of courts at New Delhi.</p>
<h5 class="flama-font">Limited Time To Bring Your Claim</h5>
<p>You and the Company agree that any cause of action arising out of or related to use of the Site or the Services must commence within one (1) year after the cause of action accrues otherwise, such cause of action will be permanently barred.</p>
<h5 class="flama-font">Survival</h5>
<p>Rights and obligations under the Terms which by their nature should survive will remain in full effect after termination or expiration of the subscription.</p>
<h5 class="flama-font">Non Waiver</h5>
<p>Any express waiver or failure to exercise promptly any right under this agreement will not create a continuing waiver or any expectation of non-enforcement.</p>
<h5 class="flama-font">Entire Agreement</h5>
<p>These Terms constitute the entire agreement between the parties with respect to the subject matter hereof and supersedes and replaces all prior or contemporaneous understandings or agreements, written or oral, regarding such subject matter.</p>


    </div>
                    
                                    </div>
	
	
	
		
		</div><!--left-part-->
		
	
@include('partials.rightsidebar')
		
	
		</div><!--center-part-->
		

	
	</div>
	<!--middle-body-->

@endsection      