<div class="col-12 p-0 top-25">
  <!--header-->
  <div class="col-12 p-0 ">
    <!--top band add-->
    <div class="container top-band">
      <div class="row mt-2 mb-2">
        <div class="col-md-12 text-center">
          @if(isset($parents[0]) && $parents[0]->status==1)
            @if($parents[0]->forpage=='story' && $parents[0]->status==1)
              {!!$parents[0]->bscript!!}
            @elseif($parents[0]->forpage=='section' && $parents[0]->status==1)              
              {!!$parents[0]->bscript!!}
            @else
              {!!$parents[0]->bscript!!}  
            @endif
          @else
          @endif
        </div>  
      </div>    
    </div>
    <!--top band add-->

    <div class="col-12">
      <div class="container p-0">
        <header id="header">
          <div class="container">
            <div class="clearfix region-header">
              <div class="logo">
                <a rel="nofollow" href="/" class="site-logo"></a>
              </div>
              <div class="custom-search">
                <form accept-charset="UTF-8" id="views-exposed-form-search-result-page-1" method="get" action="{{url('search/result')}}">

                  <div class="form--inline clearfix ui-widget">
                    <label for="edit-combine"> </label>
                    <input class="form-text search_text "  maxlength="128" size="30"  name="search_text" placeholder="Search Here" type="text" required  />
                    <input type="submit"  class="button js-form-submit form-submit btn-search" value="Apply"   />
                    
                  </div>
                  <!-- id="edit-submit-search-result" -->
                </form>
              </div>
              <nav class="clearfix">
                <div id="menu" class="mt-md-0 mt-lg-1">
                  <ul class="clearfix menu">
                    <li><a href="{{url('')}}"><i class="fas fa-home"></i></a></li>
                    @if(isset($menus))
                      @foreach($menus as $menu)
                      @if($menu->children->count() > 0)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{Str::upper($menu->title)}}
          <b class="caret"></b></a>
          <div class="dropdown-menu custom-drop-down" aria-labelledby="navbarDropdownMenuLink">
             @foreach($menu->children as $submenu)
           <a class="dropdown-item" @if(strpos($submenu->slug,'https') !== false) target="_blank"@else{{url('news')}}/{{$submenu->slug.'.html'}}@endif  href="@if(strpos($submenu->slug,'https') !== false){{$submenu->slug}} @else{{url('news')}}/{{$submenu->slug.'.html'}}@endif">{{Str::upper($submenu->title)}}</a>
            @endforeach
        </div>
        </li>
        @else
        <li>
          @if($menu->slug == 'photos' || $menu->slug == 'videos')
          <a href="{{url('/')}}/news/{{$menu->slug}}.html">{{$menu->title}}</a>
          @else
          <a href="{{url('/')}}/{{$menu->slug}}-news.html">{{$menu->title}}</a>
          @endif
        </li>
        @endif                
                      @endforeach
                    @endif
                  </ul>
                </div>
                <div class="menu-btn">
                  <div class="burger-container">
                    <div id="burger">
                      <div class="bar topBar" style="margin-bottom: 7px;width: 56%;"></div>
                    <div class="bar topBar"></div>
                    <div class="bar btmBar"></div>
                    </div>
                  </div>
                </div>
                <a class="search-icon" >search</a>
              </nav>
            </div>
          </div>
        </header>
        </div>
    </div>
    
  </div>
  <!--header-->