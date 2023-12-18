@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        @include('web.block._sidebar_i9')
        <div class="d-flex flex-wrap justify-content-between home-page">
            <div class="main-content mt-lg-4 pr-lg-3 pl-lg-0 col-lg-9 col-12 p-0">
                <div class="row mx-0 mb-4">
                    @php $item = $top_post_noi_bat[0];
                    $item = $item->post;
                    $hourCreate = substr($top_post_noi_bat[0]['displayed_time'], -8);
                    $dayCreate = substr($top_post_noi_bat[0]['displayed_time'], 0, 10);
                    unset($top_post_noi_bat[0]);
                    @endphp
                    <div class="col-lg-8 mb-2 mb-lg-0 pl-0 pr-lg-3 pr-0">
                        <a href="{{ getUrlPost($item) }}">
                            {!! genImage($item->thumbnail, 562, 333, $item->title, 'img-fluid', false) !!}
                        </a>
                    </div>
                    <div class="col-lg-4 px-lg-0">
                        <h3><a class="font-weight-bold line-height-28 font-24 text-black d-block mb-2" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                        <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                        <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                        <p class="line-height-24 font-16 m-0 text-black">{!!  get_limit_content($item->description, 250) !!}</p>
                    </div>
                </div>
                <div class="row mb-3 mx-0 d-none d-lg-flex">
                    @foreach ($top_post_noi_bat as $key => $item)
                    @php
                        $item = $item->post;
                        $hourCreate = substr($top_post_noi_bat[$key]['displayed_time'], -8);
                        $dayCreate = substr($top_post_noi_bat[$key]['displayed_time'], 0, 10);
                    @endphp
                        @if($key > 0 )
                        <div class="col-lg-4 p-0">
                            <div class="d-flex flex-wrap">
                                <div class="col-5 col-lg-12 pl-0">
                                    <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                        {!! genImage($item->thumbnail, 270, 162, $item->title, 'img-fluid', true) !!}
                                    </a>
                                </div>
                                <div class="col-7 col-lg-12 pl-0">
                                    <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-18 font-weight-bold line-height-21">{{ $item->title }}</h3></a>
                                    <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                    <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                {{-- mobile --}}
                <div class="row mb-3 mx-0 d-flex d-lg-none">
                    @foreach($top_post_noi_bat as $key => $item)
                    @php
                        $item = $item->post;
                        $hourCreate = substr($top_post_noi_bat[$key]['displayed_time'], -8);
                        $dayCreate = substr($top_post_noi_bat[$key]['displayed_time'], 0, 10);
                    @endphp
                    @if ($key > 0 && $key < 3)
                    <div class="col-6 p-0">
                        <div class="d-flex flex-wrap">
                            <div class="col-12">
                                <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                    {!! genImage($item->thumbnail, 270, 162, $item->title, 'img-fluid', true) !!}
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-16 font-weight-bold line-height-21">{{ $item->title }}</h3></a>
                                <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @if(!empty($top_post_homepage))
                <div class="row mb-3 mx-0">
                    @foreach($top_post_homepage as $key  => $item)
                    @php
                        $hourCreate = substr($item['displayed_time'], -8);
                        $dayCreate = substr($item['displayed_time'], 0, 10);
                    @endphp
                    <div class="col-lg-12 mb-3">
                        <div class="row">
                            <div class="col-5 col-lg-4 pr-0 pl-0">
                                <a class="d-block mb-2" href="{{ getUrlPost($item) }}">
                                    {!! genImage($item->thumbnail, 309, 185, $item->title, 'img-fluid', true) !!}
                                </a>
                            </div>
                            <div class="col-lg-8 col-7">
                                <a href="{{ getUrlPost($item) }}"><h3 class="text-black font-18 font-weight-bold line-height-21 font-mobile-16">{{ $item->title }}</h3></a>
                                <!-- <a href="#" class="font-12 bg-red text-white p-2 font-mobile-10">{{ $item->category->title ?? '' }}</a> -->
                                <p class="line-height-24 font-14 m-0 text-black mt-2 d-none d-lg-block">{!!  get_limit_content($item->description, 250) !!}</p>
                                <a href="{{route('author_post',['slug' => $item->author_slug, 'id' => $item->author_id])}}" class="font-14 font-weight-bold text-dark">{{$item->name_author}}</a>
                                <div class="font-12">{{ date('H:i', strtotime($hourCreate))}} ngày {{ date('d/m/Y', strtotime($dayCreate))}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="follball-league row mx-0">
                    @foreach($football_league as $item)
                        <div class="col-6 mb-3 p-0 item-league">
                            <a href="{{$item->link}}" class="football-sigle">
                                {!! genImage($item->thumbnail, 28, 28, $item->title, 'img-fluid d-block d-lg-none', true, 'fixed', true); !!}
                                {!! genImage($item->thumbnail, 60, 60, $item->title, 'img-fluid d-none d-lg-block', true, 'fixed', true); !!}
                                <span style="margin-left: 15px" class="font-mobile-12">{{ $item->title }}</span>
                                <i class="icon-simple-right icon-arrow"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="my-2 d-none d-lg-block">
                    <?php echo getBanner('center-pc')?>
                </div>
                <!-- top nhà cái bản mobile -->
                <div class="aside-box mb-3 d-lg-none d-block follball-league">
                    <div class="font-weight-bold mb-2 d-flex align-items-center">
                        <span class="text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4">TOP 10 NHÀ CÁI</span>
                    </div>
                    <div class="asb-content">
                        @foreach($listNhaCai as $key => $item)
                        @php $content = json_decode($item->content)@endphp
                        @if ($key < 5)
                        <div class="mb-3 border-sidebar-item py-3 container container-nhacai">
                            <div class="row">
                                <div class="col-5 bg-white align-items-center position-relative">
                                    <a href="{{$content->link_bet}}" target="_blank" rel="nofollow">
                                        @if($key < 5)
                                        <div class="nhacai-medal">{{ $key + 1 }}</div>
                                        @endif
                                        {!! genImage( $content->logo, 300, 300, $item->name)!!}
                                    </a>
                                </div>
                                <div class="col-7 px-0">
                                    <span class="text-dark text-dark font-weight-bold">{{ $item->name }}</span>
                                    <div class="star text-yellow">
                                        <i class="icon-star font-12"></i>
                                        <i class="icon-star font-12"></i>
                                        <i class="icon-star font-12"></i>
                                        <i class="icon-star font-12"></i>
                                        <i class="icon-star font-12"></i>
                                    </div>
                                    <div class="mb-1 d-flex justify-content-between text-center">
                                        <div class="text-center text-nowrap p-0 col mx-1">
                                            <a href="{{ $content->link_review }}" class="d-block text-white bg-yellow p-1 bg-red rounded">Review</a>
                                        </div>
                                        <div class="text-center text-nowrap p-0 col mx-1">
                                            <a href="{{ $content->link_bet }}" target="_blank" rel="nofollow" class="d-block text-white bg-blue2 p-1 rounded">Cược</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @if (!empty($keo_goc))
                    <div class="categories-homepage pt-3 mx-3 mx-lg-0">
                        <div class="font-20 font-weight-bold text-uppercase d-flex align-items-center mb-3 ml-3" style="position: relative;">
                            <a href="/soi-keo-phat-goc-c9">
                                <h2 class="font-20 font-weight-bold mb-0 text-title box-news position-ralative pl-3 text-red">Kèo phạt góc</h2>
                            </a>
                        </div>
                        <div class="row mb-3 mx-0">
                            <div class="col-lg-12 mb-3">
                                <div class="row">
                                    <div class="col-5 pr-0 pl-lg-3 pl-0">
                                        <a class="d-block mb-2" href="{{ getUrlPost($keo_goc) }}">
                                            {!! genImage($keo_goc->thumbnail, 309, 185, $keo_goc->title, 'img-fluid', true) !!}
                                        </a>
                                    </div>
                                    <div class="col-7 pl-lg-0">
                                        <a href="{{ getUrlPost($keo_goc) }}"><h3 class="text-black font-18 font-weight-bold line-height-21 font-mobile-16">{{ $keo_goc->title }}</h3></a>
                                        <p class="line-height-24 font-14 m-0 text-black mt-1 d-none d-lg-block">{!!  get_limit_content($keo_goc->description, 250) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (!empty($keo_xien))
                    <div class="categories-homepage pt-3 mx-3 mx-lg-0">
                        <div class=" font-20 font-weight-bold text-uppercase d-flex align-items-center mb-3 ml-3" style="position: relative;">
                            <a href="/keo-xien-c10">
                                <h2 class="font-20 font-weight-bold mb-0 text-title box-news position-ralative pl-3 text-red">Kèo xiên</h2>
                            </a>
                        </div>
                        <div class="row mb-3 mx-0">
                            <div class="col-lg-12 mb-3">
                                <div class="row">
                                    <div class="col-5 pr-0 pl-lg-3 pl-0">
                                        <a class="d-block mb-2" href="{{ getUrlPost($keo_xien) }}">
                                            {!! genImage($keo_xien->thumbnail, 309, 185, $keo_xien->title, 'img-fluid', true) !!}
                                        </a>
                                    </div>
                                    <div class="col-7 pl-lg-0">
                                        <a href="{{ getUrlPost($keo_xien) }}"><h3 class="text-black font-18 font-weight-bold line-height-21 font-mobile-16">{{ $keo_xien->title }}</h3></a>
                                        <p class="line-height-24 font-14 m-0 text-black mt-1 d-none d-lg-block">{!!  get_limit_content($keo_xien->description, 250) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($soikeo_today))
                <div class="font-20 py-2 pr-lg-0 pl-lg-0 px-3 px-lg-0 font-weight-bold d-flex align-items-center justify-content-between mb-3">
                        <h2 class="font-20 text-title font-weight-bold mb-0 text-uppercase box-news position-ralative pl-3 text-red" style="position: relative;">Soi kèo nhà cái hôm nay</h2>
                        <div class="border-soi-keo-hom-nay-home"></div>
                </div>
                @php
                    $betnow = getSiteSetting('site_betnow');
                    $live = getSiteSetting('site_live');
                @endphp
                @foreach($soikeo_today as $value)
                    <div class="border d-none d-lg-flex flex-wrap mb-3 shadow-box-nha-cai">
                        <div class="col-2 border-right d-flex align-items-center">
                            <div class="col-12 p-0">
                                <div class="text-center  align-self-center my-2">
                                    <span class="font-weight-bold d-block mb-2 font-16 line-height-19">{!! $value->tournament !!}</span>
                                    <span class="font-weight-bold d-block mb-2 font-40 line-height-47">
                                        {{ date('H:i',strtotime($value->scheduled)) }}
                                    </span>
                                    <span class="font-weight-bold d-block font-16 line-height-19">
                                        {{ date('d/m/Y',strtotime($value->scheduled)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 border-right d-flex flex-wrap px-0 text-center align-items-center">
                            <div class="col-6 py-3">
                                {!! genImage($value->team_home_logo, 70, 70, $value->team_home_name, 'img-fluid') !!}
                                <span class="font-weight-bold font-14 d-block">{!! $value->team_home_name !!}</span>
                            </div>
                            <div class="col-6 py-3">
                                {!! genImage($value->team_away_logo, 70, 70, $value->team_away_name, 'img-fluid') !!}
                                <span class="font-weight-bold font-14 d-block">{!! $value->team_away_name !!}</span>
                            </div>
                        </div>
                        <div class="col-3 border-right d-flex flex-wrap px-0">
                            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                                <div class="mb-2"><span class="font-weight-bold">{{ $value->hdc_asia }}</span> (Châu Á)</div>
                                <div class="mb-2"><span class="font-weight-bold">{{ $value->hdc_eu }}</span> (Châu Âu)</div>
                                <div><span class="font-weight-bold">{{ $value->hdc_tx }}</span> (Tài xỉu)</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-12 py-3 px-0 mb-1 d-flex flex-wrap justify-content-between align-items-center text-center btn-group font-13">
                                @if($value->soikeo_type == 1)
                                    <a class="bg-warning text-white py-2 mx-3 mb-2 rounded w-100" href="{{ getUrlPost($value) }}">Kèo Phạt góc</a>
                                @else
                                    <a class="bg-red text-white py-2 mx-3 mb-2 rounded w-100" href="{{ getUrlPost($value) }}">Soi kèo</a>
                                @endif
                                @if($betnow)
                                    <a rel="nofollow" href="{{$betnow}}" target="_blank" class="bg-blue2 text-white py-2 mx-3 mb-2 w-100" >Đặt cược</a>
                                @else
                                    <div class="bg-blue2 text-white py-2 mx-3 mb-2 rounded w-100">Đặt cược</div>
                                @endif
                                <a class="bg-green text-white py-2 mx-3 rounded w-100" href="{{ getUrlPost($value)}}">Dự đoán</a>
                            </div>
                        </div>
                    </div>
                    <div class="border d-flex d-lg-none flex-wrap mb-3 p-2 shadow-box-nha-cai mx-3 mx-lg-0">
                        <div class="col-3 p-2 text-center d-flex flex-wrap align-items-center align-content-center justify-content-center">
                                {!! genImage($value->team_home_logo, 70, 70, $value->team_home_name, 'img-fluid') !!}
                            <span class="font-weight-bold font-14 d-block overflow-hidden mt-2">{!! $value->team_home_name !!}</span>
                        </div>
                        <div class="col-6 px-0 text-center d-flex flex-column justify-content-center font-14">
                            <div class="d-flex justify-content-center flex-wrap py-2 mt-2">
                                <span class="font-weight-bold font-16">{!! $value->tournament !!} | {{ date('d/m/Y',strtotime($value->scheduled)) }}</span>
                                <span class="font-weight-bold font-24">
                                    {{ date('H:i',strtotime($value->scheduled)) }}
                                </span>
                            </div>
                            <div class="mb-1"><span class="font-weight-bold">{{ $value->hdc_asia }}</span> (Châu Á)</div>
                            <div class="mb-1"><span class="font-weight-bold">{{ $value->hdc_eu }}</span> (Châu Âu)</div>
                            <div><span class="font-weight-bold">{{ $value->hdc_tx }}</span> (Tài xỉu)</div>
                        </div>
                        <div class="col-3 p-2 text-center d-flex flex-wrap align-items-center align-content-center justify-content-center">
                                {!! genImage($value->team_away_logo, 70, 70, $value->team_away_name, 'img-fluid') !!}
                            <span class="font-weight-bold font-14 d-block overflow-hidden mt-2">{!! $value->team_away_name !!}</span>
                        </div>
                        <div class="col-12 px-0 pt-3 mb-0 d-flex flex-wrap justify-content-between text-center btn-group font-13">
                            @if($value->soikeo_type == 1)
                                <a class="bg-warning text-white col py-2 mx-1 rounded" href="{{ getUrlPost($value) }}">Kèo phạt góc</a>
                            @else
                                <a class="bg-red text-white col py-2 mx-1 rounded" href="{{ getUrlPost($value) }}">Soi kèo</a>
                            @endif
                            @if($betnow)
                                <a rel="nofollow" href="{{$betnow}}" target="_blank" class="bg-blue2 text-white col py-2 mx-1 px-1" >Đặt Cược</a>
                            @else
                                <div class="bg-blue2 text-white col py-2 mx-1 px-1 rounded">Đặt Cược</div>
                            @endif
                            <a class="bg-green text-white col py-2 mx-1 px-1 rounded" href="{{ getUrlPost($value)}}">Dự đoán</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            @include('web.block._sidebar')
        </div>
        <section class="col-12 col-lg-9 font-16 text-black5 text-justify post-content pl-lg-0 my-3">
            @php
                $content = getSiteSetting('site_content');
                $content =  str_replace('src','loading="lazy" src',$content);
            @endphp
            {!! $content !!}
        </section>
    </div>
@endsection
