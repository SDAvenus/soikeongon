@push('styles')
    {!! file_get_contents('web/css/game-tai-nhieu-nhat.css') !!}
@endpush
@if (!empty($nha_cai_i9))
@php
    $content = json_decode($nha_cai_i9->content, true);
@endphp
<div class="game-tai-nhieu-nhat mb-lg-0 mb-2">
    <h2 class="text-red1 text-center pt-2">
        APP TẢI NHIỀU NHẤT THÁNG
    </h2>
    <div class="row pb-3 align-items-center">
        <div class="col-lg-3 col-12 text-center mb-lg-0 mb-3 mt-lg-0 mt-2 @if(!IS_MOBILE) border-right @endif">
            {!! genImage($content['logo'], 125, 125, $nha_cai_i9['name'], 'img-fluid border-radius-35', false) !!}
        </div>
        <div class="col-lg-7 col-12 description_nha_cai">
            <div class="row">
                <div class="col-lg-7 col-12 @if(!IS_MOBILE) border-right @endif">
                    @if (!empty($content['description']))
                    <div class="m-0 d-flex"><p  style="margin-top: -5px;" class="text-red1 fw-bold fs-17 mb-0 font-16">{!!$content['description']!!}</p></div>
                    @endif
                </div>
                <div class="col-lg-5 col-12 my-lg-3 mb-3 my-lg-0 border-lg-left border-lg-right text-center @if(!IS_MOBILE) border-right @endif">
                    <div class="rateit-selected rateit-preset" style="width: 84.78px;color: #efc529;font-size: 20px;margin:auto">★★★★★</div>
                    <p class="mb-0 text-blue2">5214 - (Lượt tải game)</p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-12 d-flex flex-wrap justify-content-lg-center justify-content-between">
            <div class="button-choi-ngay d-flex justify-content-center align-item"><a rel="nofollow" target="_blank" href="{{ $content['link_bet'] ?? '' }}" class="text-white">Tải ngay</a></div>
            <div class="button-review d-flex justify-content-center align-item"><a  href="{{ $content['link_review']  ?? ''}}  " class="text-white">Xem review</a></div>
        </div>
    </div>
</div>
@endif