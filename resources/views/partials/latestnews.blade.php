<div class="col no-padding d-table titlem">
<h6 class="text-uppercase flama-font titlest"><a href="{{url('latest-news.html')}}">Latest News</a></h6>
<div class="scrollbar latestnews" id="style-4">
   @forelse(json_decode($ArrRecentNewsMiddelbarList) as $item =>  $ArrRecentNewsMiddelbarList)
<div class="media pt-3 flama"> <a href="{{$ArrRecentNewsMiddelbarList->url}}"><img src="{{Config::get('constants.SiteCmsurl')}}{{ $ArrRecentNewsMiddelbarList->photopath }}" onerror="this.src='https://www.exchange4media.com/images/e4m_logo.png'" alt="{{ $ArrRecentNewsMiddelbarList->phototitle }}" class="mr-2" ></a>
  <p class="media-body pb-1 mb-0 small lh-125"> 
  <a href="{{$ArrRecentNewsMiddelbarList->url}}">{{Str::limit($ArrRecentNewsMiddelbarList->title, $limit = 90, $end = '...')}}</a><br>
  <span class="date"><i class="far fa-clock"></i><a href="{{url('')}}/articles/{{$ArrRecentNewsMiddelbarList->publish_date}}.html" > @if(Carbon\Carbon::parse($ArrRecentNewsMiddelbarList->publish_date)->diffInWeeks() > 1)
                            <a href="article/{{$ArrRecentNewsMiddelbarList->publish_date}}.html" class="meta-date">{{(new DateTime($ArrRecentNewsMiddelbarList->publish_date))->format('d-F-Y')}} </a>
                            @else 
                            <a href="articles/{{$ArrRecentNewsMiddelbarList->publish_date}}.html" class="meta-date"><span>{{ Carbon\Carbon::parse($ArrRecentNewsMiddelbarList->publish_date.' '. $ArrRecentNewsMiddelbarList->publish_time)->diffForHumans()}}</span></a>
                            @endif</span></a>
  </p>
</div>
  @empty
<div class="media pt-3 flama"> 
</div>
@endforelse

<div class="col-lg-12 col-12">
        <p class="text-right flama-font small mt-2"><a href="{{url('latest-news.html')}}" class="pnk">SEE MORE <i class="fas fa-arrow-circle-right"></i></a></p>
        </div>
</div>
</div>



