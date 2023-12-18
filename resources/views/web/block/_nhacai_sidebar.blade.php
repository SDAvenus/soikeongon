<div class="aside-box mb-3 d-none d-lg-block">
    <div class="font-weight-bold mb-2 d-flex align-items-center">
        <span class="text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4">TOP 10 NHÀ CÁI</span>
    </div>
    <div class="asb-content">
        @foreach($listNhaCai as $key => $item)
        @php $content = json_decode($item->content) @endphp
        <div class="mb-3 border-sidebar-item py-3 container container-nhacai">
            <div class="row">
                <div class="col-5 bg-white align-items-center position-relative">
                    <a href="{{$content->link_bet}}" target="_blank" rel="nofollow">
                        @if($key < 10)
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
        @endforeach
    </div>
</div>
