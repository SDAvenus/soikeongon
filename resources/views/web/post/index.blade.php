@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        @if(isset($breadcrumb) && !empty($breadcrumb))
            {!! getBreadcrumb($breadcrumb) !!}
        @endif
        @include('web.block._sidebar_i9')
        @php
            $hourCreate = substr($oneItem['displayed_time'], -8);
            $dayCreate = substr($oneItem['displayed_time'], 0, 10);
        @endphp
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-lg-0 mr-lg-4 p-lg-0 col-lg-9 col-12">
                <!-- <div class="w-100 d-none d-lg-block" style="border: 1px solid #DBDBDB;"></div> -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="single-header">
                            <h1 class="font-30 font-weight-bold">{{$oneItem->title}}</h1>
                            <div class="font-14 font-weight-bold">{{$oneItem->name_author}}</div>
                            <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                            <div class="font-weight-bold mb-3 font-16 mt-2">{!! $oneItem->description !!}</div>
                        </div>
                        @if(!empty($arrPostNoiBat))
                            @if (!IS_MOBILE)
                            <div class="d-none d-lg-flex flex-wrap mb-3 three-post">
                                @foreach ($arrPostNoiBat as $key => $item)
                                    @if ($key < 3)
                                        <div class="col-4 py-3">
                                            <div class="col-5 col-lg-12 p-0">
                                                <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                                    {!! genImage($item->thumbnail, 260, 156, $item->title, 'img-fluid', true) !!}
                                                </a>
                                            </div>
                                            <div class="col-7 col-lg-12">
                                                <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-16 font-weight-bold line-height-21">{{ $item->title }}</h3></a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                            @if(IS_MOBILE)
                                <div class="d-lg-none d-flex flex-wrap mb-3 two-post">
                                    @foreach ($arrPostNoiBat as $key => $item)
                                        @if ($key < 2)
                                            <div class="col-6 px-1">
                                                <div class="col-lg-4 col-12 p-0">
                                                    <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                                        {!! genImage($item->thumbnail, 178, 106, $item->title, 'img-fluid', true) !!}
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-12 font-weight-bold line-height-21">{{ $item->title }}</h3></a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endif
                        @if(!empty($match->team_home_name))
                            @php
                                $hour = substr($match['scheduled'], -8);
                                $day = substr($match['scheduled'], 0, 10);
                            @endphp
                            @if(!IS_MOBILE)
                            <div class="border d-none d-lg-flex flex-wrap mb-3 my-5">
                                <div class="col-3 d-flex border-right justify-content-center">
                                    <div class="rounded p-3 align-self-center">
                                        <span class="font-weight-bold d-block mb-2 font-16 text-center ">{!! $match->tournament !!}</span>
                                        <span class="font-weight-bold d-block font-40 text-center">
                                            {{ date('H:i', strtotime($hour))}}
                                        </span>
                                        <span class="font-weight-bold d-block font-16 text-center">
                                            {{ date('d/m/Y', strtotime($day))}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-5 d-flex flex-wrap px-0 text-center align-self-center">
                                    <div class="col-6 py-3">
                                        {!! genImage($match->team_home_logo, 70, 70, $match->team_home_name, 'img-fluid') !!}
                                        <span class="font-weight-bold font-14 d-block " style="word-wrap: break-word;">{!! $match->team_home_name !!}</span>
                                    </div>
                                    <div class="col-6 py-3">
                                        {!! genImage($match->team_away_logo, 70, 70, $match->team_away_name, 'img-fluid') !!}
                                        <span class="font-weight-bold font-14 d-block" style="word-wrap: break-word;">{!! $match->team_away_name !!}</span>
                                    </div>
                                </div>
                                <div class="col-4 d-flex flex-wrap px-0 border-left">
                                    <div class="col-12 text-center d-flex flex-column justify-content-center">
                                        <div class="mb-2"><span class="font-weight-bold">{{ $match->hdc_asia }}</span> (Châu Á)</div>
                                        <div class="mb-2"><span class="font-weight-bold">{{ $match->hdc_eu }}</span> (Châu Âu)</div>
                                        <div><span class="font-weight-bold">{{ $match->hdc_tx }}</span> (Tài xỉu)</div>
                                    </div>
                                </div>
                            </div>
                            <div class="border d-flex d-lg-none flex-wrap mb-3 p-2">
                                <div class="col-3 p-2 text-center">
                                    <img class="mb-2" src="{{ $match->team_home_logo }}" width="50" height="50">
                                    <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $match->team_home_name !!}</span>
                                </div>
                                <div class="font-14 col-6 px-0 text-center d-flex flex-column justify-content-center">
                                    <div class="mb-1 font-14"><span class="font-weight-bold">{{ $match->hdc_asia }}</span> (Châu Á)</div>
                                    <div class="mb-1 font-14"><span class="font-weight-bold">{{ $match->hdc_eu }}</span> (Châu Âu)</div>
                                    <div class="font-14"><span class="font-weight-bold">{{ $match->hdc_tx }}</span> (Tài xỉu)</div>
                                </div>
                                <div class="col-3 p-2 text-center">
                                    <img class="mb-2" src="{{ $match->team_away_logo }}" width="50" height="50">
                                    <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $match->team_away_name !!}</span>
                                </div>
                                <div class="col-12 bg-gray1 d-flex justify-content-between py-2">
                                    <span class="font-weight-bold">{!! $match->tournament !!}</span>
                                    <span class="font-weight-bold font-16">
                                        <img class="mr-1" src="/web/images/icon-time.svg" alt="time icon" width="18" height="18">
                                        {{ date('H:i | d/m/Y',strtotime($match->scheduled)) }}
                                    </span>
                                </div>
                            </div>
                            @endif
                            @if (IS_MOBILE)
                            <div class="border d-lg-none d-flex flex-wrap mb-3 my-5">
                                <span class="font-weight-bold d-block mb-2 font-16 text-center col-12 pt-3">{!! $match->tournament !!} | {{ date('d/m/Y', strtotime($day))}}</span>
                                <div class="row col-12">
                                    <div class="text-center col-3">
                                        {!! genImage($match->team_home_logo, 70, 70, $match->team_home_name, 'img-fluid') !!}
                                        <span class="font-weight-bold font-14 d-block">{!! $match->team_home_name !!}</span>
                                    </div>
                                    <div class="text-center col-6 p-0">
                                        <div class="rounded pb-3">
                                            <span class="font-weight-bold d-block font-30">
                                                {{ date('H:i', strtotime($hour))}}
                                            </span>
                                            <div class="mb-1 font-12"><span class="font-weight-bold">{{ $match->hdc_asia }}</span> (Châu Á)</div>
                                            <div class="mb-1 font-12"><span class="font-weight-bold">{{ $match->hdc_eu }}</span> (Châu Âu)</div>
                                            <div class="mb-1 font-12"><span class="font-weight-bold">{{ $match->hdc_tx }}</span> (Tài xỉu)</div>
                                        </div>
                                    </div>
                                    <div class="text-center col-3">
                                        {!! genImage($match->team_away_logo, 70, 70, $match->team_away_name, 'img-fluid') !!}
                                        <span class="font-weight-bold font-14 d-block">{!! $match->team_away_name !!}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif

                        <div class="line-height-24 entry-content">
                            @if(request()->has('lich-su-doi-dau'))
                                {!! tableOfContent(preg_replace('#<strong>(.*?)Lịch sử đối đầu(.*?)</strong>#',
                                                                '<strong id="lich-su-doi-dau">Lịch sử đối đầu:</strong>',
                                                                $oneItem->content)) !!}
                            @else
                                {!! tableOfContent($oneItem->content) !!}
                            @endif
                        </div>
                        @if (!empty($author))
                            <div class="p-3 border border-grey mb-3" style="background: #DFEDFF;">
                                <div class="d-flex mb-2">
                                    <!-- <img loading='lazy' class='img-fluid mr-3' src='{{$author->avatar}}' alt='' width='110' height='85'>          -->
                                    <div class="mr-3">
                                        {!! genImage($author->avatar, 110, 85, $author->name,) !!}
                                    </div>
                                    <div class="font-weight-bold">
                                        <p class="mb-2"><strong>Chuyên gia: <a class="" rel="nofollow" href="{{route('author_post',['slug' => $author->slug, 'id' => $author->id])}}">{{$author->name ?? ''}}</a></strong></p>
                                    </div>
                                </div>
                                <p class="m-0">{!! $author->info ?? ''!!}</p>
                            </div>
                        @endif
                        @if (!empty($tags))
                            @foreach ($tags as $tag) 
                                <a href="{{route('tag_page',['slug' => $tag->slug, 'id' => $tag->id])}}" class="d-inline-block text-uppercase bg-tag px-3 py-1 mb-2 mr-1 text-dark">#{{$tag['title']}}</a>
                            @endforeach
                        @endif
                        <div class="fb-comments" data-href="{{getUrlPost($oneItem)}}" data-width="100%" data-numposts="5"></div>
                        <!-- lst news -->
                        <div class="font-18 font-weight-bold mt-4 d-flex align-items-center text-red">
                            <div class="ml-1 square-blue text-red"></div>
                            TIN CÙNG CHUYÊN MỤC
                        </div>

                        <section class="topic" id="ajax_content">
                        @if(!empty($related_post))
                            @foreach($related_post as $item)
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-5 pr-0 pl-0 pl-lg-3">
                                            <a href="{{getUrlPost($item)}}">
                                                {!! genImage($item->thumbnail, 300, 200, $item->title, 'img-fluid') !!}
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <a class="font-weight-bold @if(IS_MOBILE) font-16 @else font-18 @endif text-dark d-block mb-2" href="{{getUrlPost($item)}}">{{$item->title}}</a>
                                            <a href="{{ getUrlCate($item->category) }}" class="font-12 bg-red text-white p-2 font-mobile-10">{{ $item->category->title ?? '' }}</a>
                                            <p class="line-height-24 d-none d-lg-block mt-2 font-12">{!!  get_limit_content($item->description, 200) !!}</p>
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
                </div>
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .collapsible {
            cursor: pointer;
        }

        .collapsible:after {
            content: '\2630';
            float: right;
        }

        .collapsible.active:after {
            content: "\1F5D9";
        }
    </style>
@endpush
