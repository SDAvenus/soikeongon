<div class="kinh-nghiem-soi-keo mt-3">
    <div class="font-weight-bold mb-2 d-flex align-items-center">
        <span class="text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4 text-upercase">Kinh nghiệm soi kèo</span>
    </div>
    <div class="font-14 font-weight-bold text-black2">
        @if (!empty($kinh_nghiem_soi_keo))
            @foreach ($kinh_nghiem_soi_keo as $item)
            <div class="pt-2">
                <div class="row">
                    <div class="col-5 col-lg-12 p-0 px-lg-3">
                        <a href="{{ getUrlPost($item) }}">
                            {!! genImage($item->thumbnail, 300, 200, $item->title, 'img-fluid') !!}
                        </a>
                    </div>
                    <div class="col-7 col-lg-12 pl-3 p-0 px-lg-3">
                        <h3><a class="font-weight-bold font-14 text-black d-block pt-0 pt-lg-2 line-height-21" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
