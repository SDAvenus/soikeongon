@php $lich_thi_dau = getLichThiDau();
@endphp
<div class=" aside-box  mb-2" id="lich-thi-dau-container">
    <div class="p-10 mb-20 box-lich-thi-dau">
        <div class="d-flex text-title font-weight-bold position-relative text-title line-height-23 font-20 text-red pl-4">
            LỊCH BÓNG ĐÁ
        </div>
        <div class="content-block-identify d-flex flex-wrap">
            <section class="d-flex mt-10 fb_box-hot-league">
            </section>
            <section class="d-flex clearfix fb_box_date bg-white w-100 py-3">
                <div class="justify-content-end fb-sub-menu overflow-x-auto w-100">
                    <ul class="d-flex list-unstyled mb-0 list-date-ltd justify-content-between">
                        @php
                        $weekday = date("l");
                        $weekday = strtolower($weekday);
                        $tomorow = '';
                        switch($weekday) {
                            case 'monday':
                                $weekday = 'T2';
                                $tomorow = 'T3';
                                break;
                            case 'tuesday':
                                $weekday = 'T3';
                                $tomorow = 'T4';
                                break;
                            case 'wednesday':
                                $weekday = 'T4';
                                $tomorow = 'T5';
                                break;
                            case 'thursday':
                                $weekday = 'T5';
                                $tomorow = 'T6';
                                break;
                            case 'friday':
                                $weekday = 'T6';
                                $tomorow = 'T7';
                                break;
                            case 'saturday':
                                $weekday = 'T7';
                                $tomorow = 'CN';
                                break;
                            default:
                                $weekday = 'CN';
                                $tomorow = 'T2';
                                break;
                        }
                        @endphp
                        @for ($i = 0; $i < 6; $i++)
                            <li class="mr-1 @if ($i == 0) sub-menu-active @endif">
                                <a class="text-center btn-load-widget-calendar btn-show-ltd" href="#" data-date="{{ date('Y-m-d', strtotime('+'.$i.' day')) }}">
                                    <span class="font-10 date-word">{{ $i == 0 ? $weekday  : ($i == 1 ? $tomorow  : getDay(date('Y-m-d', strtotime('+'.$i.' day')), 1)) }}</span>
                                    <br>
                                    <span class="font-10 font-bold">{{ date('d/m', strtotime('+'.$i.' day')) }}</span>
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </section>
            <div class="mt-10 pt-0 content-football">
                <section class="clearfix content_box_home">
                    <div class="b_gameweek">
                        <div class="w-100 table-bordered list-schedule-all ajax-content-ltd">
                            {!! $lich_thi_dau !!}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@push('styles')
    {!! file_get_contents('web/css/lich_thi_dau.css') !!}
@endpush
