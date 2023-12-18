@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-lg-3">
    <div class="d-block d-lg-flex justify-content-between flex-wrap">
        <div class="d-block col-12 p-0">
            @if(!empty($breadCrumb))
                {!! getBreadcrumbAuthor($breadCrumb) !!}
            @endif
        </div>
        @include('web.block._sidebar_i9')
        <div class="main-content mt-2 mt-lg-4 p-3 p-lg-0 col-12 col-lg-9 pr-lg-4">
            <section class="mg-t-20 clearfix content_box_home box-list-schedule-all">
                @if (!empty($author))
                    <div class="p-3 border border-grey mb-3" style="background: #DFEDFF;">
                        <div class="d-flex mb-2">
                            <!-- <img loading='lazy' class='img-fluid mr-3' src='{{$author->avatar}}' alt='' width='110' height='85'>          -->
                            <div class="mr-3">
                                {!! genImage($author->avatar, 110, 85, $author->name,) !!}
                            </div>
                            <div class="font-weight-bold">
                                <p class="mb-2"><strong>Chuyên gia: <a class="" rel="nofollow" href="{{route('author_post', ['slug' => $author->slug, 'id' => $author->id])}}">{{$author->name ?? ''}}</a></strong></p>
                            </div>
                        </div>
                        <p class="m-0">{!! $author->info ?? ''!!}</p>
                    </div>
                @endif
            </section>
            <div class="fb-comments" data-href="" data-width="100%" data-numposts="5"></div>
            <!-- lst news -->
            <div class="font-18 font-weight-bold mt-4 d-flex align-items-center text-red">
                <div class="ml-1 square-blue text-red"></div>
                BÀI VIẾT TÁC GIẢ
            </div>
            <section class="topic" id="ajax_content">
            @if(!empty($allPost))
                @foreach($allPost as $item)
                @php 
                    $hourCreate = substr($item['displayed_time'], -8);
                    $dayCreate = substr($item['displayed_time'], 0, 10);
                @endphp
                    <div class="py-3">
                        <div class="row">
                            <div class="col-5 pr-0 pl-0 pl-lg-3">
                                <a href="{{getUrlPost($item)}}">
                                    {!! genImage($item->thumbnail, 300, 200, $item->title, 'img-fluid') !!}
                                </a>
                            </div>
                            <div class="col-7">
                                <a class="font-weight-bold @if(IS_MOBILE) font-16 @else font-18 @endif text-dark d-block mb-2" href="{{getUrlPost($item)}}">{{$item->title}}</a>
                                <p class="line-height-24 d-none d-lg-block mt-2 font-12">{!!  get_limit_content($item->description, 200) !!}</p>
                                <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            </section>
            <div class="category-load-more text-center my-3">
                <a href="javascript:;" class="d-block border-content px-5 py-2 text-decoration-none load-more position-relative mx-auto font-16 text-black2 font-weight-bold">Xem thêm</a>
            </div>
        </div>
        @include('web.block._sidebar')
    </div>
</div>
@endsection
