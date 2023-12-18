@if (isset($id) && $id != 12)
@foreach($post as $key => $item)
    @php 
        $hourCreate = substr($item['displayed_time'], -8);
        $dayCreate = substr($item['displayed_time'], 0, 10);
    @endphp
    <div class="py-3 pd-0">
        <div class="row">
            <div class="col-5 pl-0 pl-lg-3">
                <a href="{{ getUrlPost($item) }}">
                    {!! genImage($item->thumbnail, 300, 200, $item->title, 'img-fluid') !!}
                </a>
            </div>
            <div class="col-7 p-0">
                <h3><a class="font-weight-bold font-18 text-black d-block mb-2 line-height-21 font-mobile-16" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                <!-- <a href="{{ getUrlCate($item->category) }}" class="font-12 bg-red text-white p-2 font-mobile-10">{{ $item->category->title ?? '' }}</a> -->
                <p class="d-none d-lg-block font-14 text-black font-weight-400 mt-2">{!!  get_limit_content($item->description, 400) !!}</p>
                <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
            </div>
        </div>
    </div>
@endforeach
@endif

@if (isset($id) && $id == 12)
    <div class="d-flex flex-wrap">
        @foreach($post as $key => $item)
        <div class="col-12 col-lg-6 position-relative mb-4 ">
            <div class="image-da-ga" >
                <a href="{{ getUrlPost($item) }}">
                    {!! genImage($item->thumbnail, 416, 247, $item->title, 'img-fluid') !!}
                </a>
            </div>
            <div class="content-da-ga">
                <img class="mr-2" src="/web/images/button-play.png" style="width:48px; height: 36.5px;" />
                <div class="info-da-ga">
                    <h3><a class="font-weight-bold line-height-21 font-18 text-white d-block mb-2" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                    <p class="mb-0 display-time font-14 text-white">{{ date('d-m-Y', strtotime($item->displayed_time)) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
