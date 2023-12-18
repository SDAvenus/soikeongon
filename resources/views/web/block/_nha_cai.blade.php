@foreach($listNhaCai as $key => $item)
    @php $content = json_decode($item->content) @endphp
    <div class="d-flex flex-wrap border my-3 position-relative nhacai-uy-tin-item shadow-box-nha-cai">
        <span class="nhacai-uy-tin-medal text-white font-16 font-weight-bold top-0 position-absolute text-center">#{{ $key + 1 }}</span>
        <span class="count-star text-white font-16 font-weight-bold position-absolute text-center">5.0</span>
        <div class="col-12 col-lg-4 d-flex justify-content-lg-end justify-content-center align-items-center px-lg-3 py-lg-0 order-0 border-may-tinh-du-doan border-bottom-mobile">
            <div class="p-2 p-lg-2">
                {!! genImage($content->logo, 115, 115, $item->name, 'img-fluid rounded') !!}
            </div>
        </div>
        <div class="col-12 col-lg-4 px-0 d-flex order-3 order-lg-2 border-may-tinh-du-doan pt-3 pt-lg-0">
            <div class="d-flex flex-lg-column justify-content-lg-center justify-content-between align-items-start px-4 w-100">
                <div class="text-blue2 font-weight-bold font-24">{{ $item->name }}</div>
                <span class="star text-yellow d-block py-2">
                    <i class="icon-star pr-2"></i>
                    <i class="icon-star pr-2"></i>
                    <i class="icon-star pr-2"></i>
                    <i class="icon-star pr-2"></i>
                    <i class="icon-star pr-2"></i>
                </span>
                {{-- <p class="font-weight-bold font-14 text-dark d-none d-lg-block">{{ $content->count ?? '' }}</p> --}}
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-between order-3 order-lg-2 pb-2 pb-lg-0">
            <div class="font-16 d-flex align-items-center mb-3 mb-lg-0  w-100 text-black2">
                {!! $content->description ?? '' !!}
            </div>
            <div class="w-100 d-lg-flex d-none">
                <a href="{{ $content->link_bet }}" rel="nofollow" class="d-block p-2 mb-2 text-white text-nowrap bg-red rounded mr-2" style="height: max-content; width:max-content;"><i class="icon-download-cloud mr-2"></i> Cược ngay</a>
                <a href="{{ $content->link_review }}" class="d-block p-2 text-white  text-nowrap bg-blue2 rounded" style="height: max-content; width:max-content;"><i class="icon-paperplane mr-2"></i> Xem review</a>
            </div>
            <a href="{{ $content->link_bet }}" rel="nofollow" class="d-block d-lg-none p-2 mb-2 text-white text-nowrap bg-red rounded mr-2" style="width:45%;height: max-content;"><i class="icon-download-cloud mr-2"></i> Cược ngay</a>
                <a href="{{ $content->link_review }}" class="d-block d-lg-none p-2 text-white  text-nowrap bg-blue2 rounded" style="width:45%;height: max-content;"><i class="icon-paperplane mr-2"></i> Xem review</a>
        </div>
    </div>
@endforeach
