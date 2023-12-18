@if(!empty($posts->count()))
<div class="font-20 py-2 pr-3 pl-0 font-weight-bold text-uppercase d-flex align-items-center mb-3">
    <span class="square-blue mr-2"></span>
    <h2 class="font-20 font-weight-bold mb-0 text-title box-news">{{ $posts[0]->category->title ?? '' }}</h2>
</div>
<div class="cb-content mb-1 row">
    @php $item = $posts[0]; unset($posts[0]) @endphp
    <h3 class="col-sm-12"><a class="line-height-24 font-16 text-dark d-block mb-2 font-weight-bold" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
    <div class="mb-2 col-6 pr-0">
        <a href="{{ getUrlPost($item) }}">
            {!! genImage($item->thumbnail, 185, 110, $item->title, 'img-fluid') !!}
        </a>
    </div>
    <div class="col-6 ">
        <p class="line-height-24 font-14 ">{!! get_limit_content($item->description, 130) !!}</p>
    </div>
</div>
<div class="lst-news ">
    @foreach($posts as $item)
        <div class="mb-1">
            <div class="">
                <span class="little-square-blue"></span>
            </span><a href="{{ getUrlPost($item) }}" class="text-black font-15"><span class="square-blue mr-2"> </span>{{ $item->title }}</a>
            </div>
        </div>
    @endforeach
</div>
@endif
