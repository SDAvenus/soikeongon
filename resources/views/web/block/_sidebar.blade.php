@php
    $url = $_SERVER['REQUEST_URI'];
@endphp
<aside class="sidebar-right pt-4 px-3 px-lg-0 col-lg-3 col-12 d-flex flex-column mb-3">
    @if(getBanner('top-sidebar'))
    <div class="d-flex justify-content-center mb-3 mw-100" style="height:250px;">
        {!! getBanner('top-sidebar') !!}
    </div>
    @endif
    <!--    nha cai-->

    @if(!empty($listNhaCai))
    <div class="d-flex">
        @include('web.block._nhacai_sidebar', ['listNhaCai' => $listNhaCai])
    </div>
    @endif
    @include('web.block._lich_thi_dau_sidebar')
    @include('web.block._ket_qua_thi_dau_sidebar', ['ket_qua_thi_dau_siderbar' => $ket_qua_thi_dau_siderbar])
    @include('web.block._kinh_nghiem_soi_keo_sidebar')

</aside>
