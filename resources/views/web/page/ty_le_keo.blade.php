@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-lg-3 d-flex flex-wrap">
    <div class="w-100">
    @include('web.block._sidebar_i9')
    </div>
@if(IS_MOBILE)
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
        @endif
    <div class="d-block d-lg-flex justify-content-between col-lg-9 col-12">
        @push('styles')
            {!! file_get_contents('web/css/tylekeo.css') !!}
        @endpush
        @if (!IS_AMP)
        <script defer src="/web/js/tylekeo.js?v=0.5"></script>
        <script defer src="/web/js/tylekeo1.js?v=0.5"></script>
        @endif
        <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-2 p-lg-0 w-100">
            <h2>
                {!! $oneItem->meta_title !!}
            </h2>
            @if($oneItem->description)
            <div class="cat_des font-14 border-bottom mb-3 py-2">
                {!! $oneItem->description !!}
            </div>
            <div class="d-flex">
                <span class="icon-search btn"></span>
                <input type="text" placeholder="Tìm kiếm..." class="mb-2 rounded form-control col-lg-4 col-6" name="search-soi-keo" id="search-soi-keo">

                <select class="form-control ml-2 mb-2 col-4 col-lg-2" id="searching-by">
                    <option value="1">Đội bóng</option>
                    <option value="2">Giải đấu</option>
                </select>

            </div>
            <div class="table-ngay-ty-le-keo">
                <ul class=" sub-menu nav nav-pills">
                    <li class="">
                        <a class="text-center btn-show-keo-truc-tuyen" href="#">
                            <span class=" date-word">Kèo trực tuyến</span>
                        </a>
                    </li>
                    @for ($i = 0; $i < 6; $i++)
                    <li class="@if($i == 0 ) sub-menu-active @endif">
                        <a class="text-center btn-show-ty-le-keo" href="#" data-index="{{ $i }}">
                            <span class="date-word">{{ $i == 0 ? 'Hôm nay'  : ($i == 1 ? 'Ngày mai'  : getDay(date('Y-m-d', strtotime('+'.$i.' day')), 1)) }}</span>
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
            @endif
            <div class="ty-le-keo-page">
                <div class="head-odd-page">
                    <div class="time-info">Giờ</div>
                    <div class="club-name unstyled">Trận đấu</div>
                    <div class="odds-content">Tỷ lệ</div>
                    <div class="odds-content">Tài xỉu</div>
                    <div class="odds-content europe-ratio">1x2</div>
                </div>
                <div class="line-height-24 entry-content padding-bot-50 ajax-content-tlk">
                    {!! $tylekeohangngay ?? "" !!}
                </div>
            </div>
            @if ($oneItem->content)
            <div class="line-height-24 entry-content padding-bot-50">
                {!! $oneItem->content !!}
            </div>
            @endif
        </div>
    </div>
    @include('web.block._sidebar')
</div>
@endsection
@push('scripts')
<script defer type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        if(is_mobile){
            $('.keo-search').each(function(i, e){
                let childs = $(e).children();
                childs[0].setAttribute('width', '12%')
                childs[1].setAttribute('width', '34%')
                childs[2].setAttribute('width', '22%')
                childs[3].setAttribute('width', '22%')
                childs[4].setAttribute('width', '10%')
                childs[5].remove()
                childs[6].remove()
                childs[7].remove()
            })
        }
    });
</script>
@endpush
