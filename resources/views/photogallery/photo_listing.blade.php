@extends('layouts.appinternal')
@section('content')
 <div class="ot-panel-block panel-light">						
    <div class="title-block">
            <h2>Photo Gallery</h2>
    </div>
    <div class="photo-gallery-blocks lets-do-2">
    @forelse($ArrlistingPhotos as  $ArrlistingPhoto)
        <!-- BEGIN .item -->
        <div class="item" >
                <div class="item-header">
                        <a href="/photogallery/{!! Helper::rscUrl($ArrlistingPhoto->title)!!}-{{ $ArrlistingPhoto->id }}.html" class="image-hover"><img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.ALBUM_IMAGE_DIR')}}{{ $ArrlistingPhoto->photopath }}" alt="{{ $ArrlistingPhoto->title }}"></a>
                </div>
                <div class="item-content">
                        <h6><a href="/photogallery/{!! Helper::rscUrl($ArrlistingPhoto->title)!!}-{{ $ArrlistingPhoto->id }}.html" >{{ $ArrlistingPhoto->title }}</a></h6>

                </div>
        <!-- END .item -->
        </div>
     @empty
        <div class="item" >
            <div class="item-header">
                    
            </div>
            <div class="item-content">
   
            </div>
        <!-- END .item -->
        </div>
     @endforelse

    </div>

    {!! $ArrlistingPhotos->links('pagination.pagination') !!}
</div>

    
@endsection           