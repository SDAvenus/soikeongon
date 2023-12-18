<div class="col-5 col-lg-4 mb-3">
    <a href="{{getUrlPost($data)}}" title="{{$data->title}}" class="">
        <img src="{{getThumbnail($data->thumbnail, 310, 207)}}" alt="" class="img-fluid" width="310" height="207">
    </a>
</div>
<div class="col-7 col-lg-8">
    <h3 class="fs-20 fw-bold">
        <a href="{{getUrlPost($data)}}" title="{{$data->title}}" class="max-line-3 max-line-lg-1 text-black3">{{$data->title}}</a>
    </h3>
    <div class="max-line-4 text-black4 d-none d-lg-block font-14">{!! $data->description !!}</div>
</div>
