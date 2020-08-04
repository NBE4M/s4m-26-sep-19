@extends('layouts.appinternal')
@section('content')
<!--<p><a href="/">Home</a> >> <a href="/all-pthotos.html">Photo Gallery</a> >>Photo Album</p>-->

    
   
    
    <div class="ot-panel-block panel-light">

         <div class="title-block">
            <h2>Photo Album</h2>
        </div>
							
        <div class="shortcode-content">
            <div class="article-header">

                <h1>{{preg_replace("/[^A-Za-z0-9_]/"," ", $title)}} </h1>
                
                <div class="article-header-meta">
                        <a href="#"class="meta-item">
                            <i class="fa fa-clock-o"></i>
                            <span>{{(new DateTime($ArrViewPhotos->created_at ))->format('d-F-Y')}}</span>
                        </a>
                        
                        <div class="meta-item">
                            
                            <i class="fa fa-text-height"></i>
                            <span>Font Size &nbsp;</span>
                            <a href="#font-size-down"><i class="fa fa-minus-square"></i></a>
                            <span class="f-size-number">16</span>    
                            <a href="#font-size-up"><i class="fa fa-plus-square"></i></a>
                            
                        </div>
                        <a href="#article-share" class="meta-share-button meta-item">
                            <i class="fa fa-share"></i>
                            <span>Share</span>
                        </a>
                    </div>
                 <div class="share-popup-block">
                        <span class="st_sharethis_large" st_image=<%=sstoryimg% displaytext='ShareThis'></span>

                                        <span class='st_facebook_large'displaytext='Facebook'></span><span class='st_twitter_large' displaytext='Tweet'>

                                            </span><span class='st_linkedin_large' displaytext='LinkedIn'></span><span class='st_pinterest_large'

                                                displaytext='Pinterest'></span>

                                                <span class='st_flipboard_large'

                                                displaytext='Flipboard'></span>

                                                <span class='st_email_large' displaytext='Email'></span>

                                                <span class='st_fblike_large' displaytext='Facebook Like'>

                                                </span>
                    </div>   

            </div>
        </div>

        <div class="blog-articles articles-big">
            @forelse($ArrViewPhoto as  $ArrViewPhoto)
                <div class="item" data-self-cat="fashion gadgets">
                        <div class="item-header">
                               <img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.ALBUM_IMAGE_DIR')}}{{ $ArrViewPhoto->photopath }}" alt="{{ $ArrViewPhoto->photopath }}" >
                        </div>
                        <div class="item-content">
                                <span class="article-meta">
                                        <i class="fa fa-picture-o"></i>&nbsp;&nbsp;{{$ArrViewPhoto->photo_by}}
                                </span>
                                <p>{{ $ArrViewPhoto->title }}</p>
                        </div>
                </div>
            @empty
                <div class="item" data-self-cat="fashion gadgets">
                    <div class="item-header">

                    </div>
                    <div class="item-content">
                        <span class="article-meta">

                        </span>

                    </div>
                </div>
            @endforelse

        </div>
    </div>

  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>

 

    $("a[href='#font-size-up']").click(function(){var cursize=$('.f-size-number').html();if(parseInt(cursize)<24){$('.f-size-number').html(parseInt(cursize)+2);$('p').css("font-size",(parseInt(cursize)+2)+"px");}return false;});$("a[href='#font-size-down']").click(function(){var cursize=$('.f-size-number').html();if(parseInt(cursize)>16){$('.f-size-number').html(parseInt(cursize)-2);$('p').css("font-size",(parseInt(cursize)-2)+"px");}return false;});

</script>  
@endsection           