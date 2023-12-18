@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="d-block d-lg-none">
                @if(isset($breadCrumb) && !empty($breadCrumb))
                    {!! getBreadcrumb($breadCrumb) !!}
                @endif
            </div>
            <div class="main-content mt-2 mt-lg-4 mr-lg-4">
                <h2 class="d-none d-lg-block text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4 text-uppercase w-100 mb-3">
                    Trực tiếp đá gà
                </h2>
                <div class="list-more-posts">
                    <div class="row">
                        @if(!empty($post[0]))
                        <div class="col-12 mx-0 mb-4 position-relative px-0 px-lg-3">
                            @php $item = $post[0]; unset($post[0]) @endphp
                            <div class="mb-2 mb-lg-0 image-da-ga">
                                <a href="{{ getUrlPostDaGa($item) }}">
                                    {!! genImage($item->thumbnail, 853, 480, $item->title, 'img-fluid', false) !!}
                                </a>
                            </div>
                            <div class="content-da-ga">
                                <img class="mr-2" src="/web/images/button-play.png" style="width:73px;height:55px;"/>
                                <div class="info-da-ga">
                                    <h3><a class="font-weight-bold line-height-28 font-24 text-white d-block mb-2" href="{{ getUrlPostDaGa($item) }}">{{ $item->title }}</a></h3>
                                    <p class="mb-0 display-time font-14 text-white">{{ date('d-m-Y', strtotime($item->displayed_time)) }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @include('web.block._load_more_post', ['post' => $post])
                    </div>
                </div>
                <div class="my-3">
                    <a href="#" data-catid="{{$oneItem->id ?? 0}}" data-page="{{$page ?? null}}" class="btn-cat-load-more d-block text-black border p-2 text-center font-weight-bold">
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
