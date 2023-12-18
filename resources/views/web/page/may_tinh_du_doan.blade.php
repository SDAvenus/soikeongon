@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-lg-3">
@include('web.block._sidebar_i9')
    <div class="d-block d-lg-flex justify-content-between">
        @push('styles')
            {!! file_get_contents('web/css/data.css') !!}
        @endpush
        @push('styles')
            {!! file_get_contents('web/css/maytinhdudoan.css') !!}
        @endpush
        <div class="d-block d-lg-none">
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
        </div>
        <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-3 p-lg-0 col-12 col-lg-9">
            <div class="d-flex justify-content-between flex-wrap">
                <span class="text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4 text-uppercase mb-3" style="width:max-content;">Máy tính dự đoán</span>
            </div>
            @if (!empty($oneItem->description))
            <div class="line-height-24 entry-content">
                {!! $oneItem->description !!}
            </div>
            @endif
            <section class="mg-t-20 clearfix content_box_home box-list-schedule-all">
                {!! tableOfContent($may_tinh_du_doan) ?? "" !!}
            </section>
            @if (!empty($oneItem->content))
            <div class="cat_des border-bottom my-3">{!! tableOfContent($oneItem->content) !!}</div>
            @endif

            @if (!empty($lich_thi_dau))
            <div class="bg-dark p-2 font-18 mb-2">
                <div class="pl-3 p-1" style="background:url('/web/images/icon-title-hover.svg') no-repeat top left;">Lịch thi đấu bóng đá Anh</div>
            </div>
            <div class="ltd-vsk table-xs">
                @php
                    $content = str_replace('data-src','src',$lich_thi_dau->content);
                    $content = str_replace('<table','<table class="table table-bordered"',$content);
                    echo $content
                @endphp
            </div>
            @endif
            <!-- @if (!empty($oneItem->content))
            <div class="line-height-24 entry-content">
                {!! $oneItem->content !!}
            </div>
            @endif -->
        </div>
        @include('web.block._sidebar')
    </div>
</div>
@endsection
