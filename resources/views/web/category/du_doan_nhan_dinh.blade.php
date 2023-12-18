@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        @if(IS_MOBILE)
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
        @endif
        @include('web.block._sidebar_i9')
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-3 p-lg-0">
                @if(!empty($oneItem->description))
                    <div class="cat_des text-justify font-16 mb-3">
                        {!! $oneItem->description !!}
                    </div>
                @endif

                <div class="list-more-posts">
                    @if (!IS_MOBILE)
                    <div class="row">
                        <div class=" mx-0 mb-4 col-8">
                            @if(!empty($post[0]))
                                @php 
                                    $item = $post[0]; 
                                    $hourCreate = substr($item['displayed_time'], -8);
                                    $dayCreate = substr($item['displayed_time'], 0, 10);
                                    unset($post[0]);
                                @endphp
                                <div class="col-lg-12 mb-2 mb-lg-0 pd-0 pr-0">
                                    <a href="{{ getUrlPost($item) }}">
                                        {!! genImage($item->thumbnail, 562, 333, $item->title, 'img-fluid', false) !!}
                                    </a>
                                </div>
                                <div class="col-lg-12 px-lg-0">
                                    <h3><a class="font-weight-bold line-height-28 font-24 text-black d-block mb-2 my-3" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                                    <p class="line-height-24 font-16 m-0 text-black">{!!  get_limit_content($item->description, 250) !!}</p>
                                    <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                    <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-4 mx-0 mb-4 pl-0">
                            @foreach($post as $key => $item)
                                @if ($key < 3)
                                @php 
                                    $hourCreate = substr($item['displayed_time'], -8);
                                    $dayCreate = substr($item['displayed_time'], 0, 10);
                                    unset($post[$key]);
                                @endphp
                                    <div class="row">
                                        <div class="col-5 col-lg-12 pr-0">
                                            <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                                {!! genImage($item->thumbnail, 270, 162, $item->title, 'img-fluid', true) !!}
                                            </a>
                                        </div>
                                        <div class="col-7 col-lg-12">
                                            <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-18 font-weight-bold line-height-21 mb-0">{{ $item->title }}</h3></a>
                                            <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                            <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($post as $key => $item)
                            @if ($key < 6)
                            @php 
                                $hourCreate = substr($item['displayed_time'], -8);
                                $dayCreate = substr($item['displayed_time'], 0, 10);
                                unset($post[$key]);
                            @endphp
                                <div class="col-4 pl-0">
                                    <div class="col-5 col-lg-12 pr-0">
                                        <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                            {!! genImage($item->thumbnail, 270, 162, $item->title, 'img-fluid', true) !!}
                                        </a>
                                    </div>
                                    <div class="col-7 col-lg-12">
                                        <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-18 font-weight-bold line-height-21 mb-0">{{ $item->title }}</h3></a>
                                        <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                        <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                    @if (IS_MOBILE)
                        <div class="mx-0 mb-4 col-12 p-0">
                            @if(!empty($post[0]))
                            @php 
                                $item = $post[0]; 
                                $hourCreate = substr($item['displayed_time'], -8);
                                $dayCreate = substr($item['displayed_time'], 0, 10);
                                unset($post[0]);
                            @endphp
                                <div class="col-lg-12 mb-2 mb-lg-0 p-0">
                                    <a href="{{ getUrlPost($item) }}">
                                        {!! genImage($item->thumbnail, 562, 333, $item->title, 'img-fluid', false) !!}
                                    </a>
                                </div>
                                <div class="col-lg-12 px-0">
                                    <h3><a class="font-weight-bold line-height-28 font-24 text-black d-block mb-2" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                                    <p class="line-height-24 font-16 m-0 text-black">{!!  get_limit_content($item->description, 250) !!}</p>
                                    <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                    <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mx-0 mb-4 row p-0">
                            @foreach($post as $key => $item)
                                @if ($key < 3)
                                @php 
                                    $hourCreate = substr($item['displayed_time'], -8);
                                    $dayCreate = substr($item['displayed_time'], 0, 10);
                                    unset($post[$key]);
                                @endphp
                                    <div class="col-6 p-0">
                                        <div class="col-12 col-lg-12 pl-0 ">
                                            <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                                {!! genImage($item->thumbnail, 300, 162, $item->title, 'img-fluid', true) !!}
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-12 p-0 pr-3">
                                            <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-18 font-weight-bold line-height-21">{{ $item->title }}</h3></a>
                                            <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                            <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                    </div>
                    @endif
                    @include('web.block._load_more_post', ['post' => $post])
                </div>
                <div class="my-3">
                    <a href="javascript:void(0)" data-catid="{{$oneItem->id ?? 0}}" data-page="{{$page ?? null}}" class="border-content btn-cat-load-more d-block p-2 text-center font-16 text-black2 font-weight-bold">
                        Xem thêm
                    </a>
                </div>

                @if(!empty($oneItem->content))
                    <div class="cat_des text-justify mb-3">
                        {!! parse_content($oneItem->content) !!}
                    </div>
                @endif
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection
