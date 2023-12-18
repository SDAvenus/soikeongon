<footer class="text-grey font-13 w-100 px-0">
    <div class="menu-footer bg-red d-none d-lg-block">
        <ul class="container navbar-nav w-100 d-flex justify-content-between flex-row mb-0 px-4 px-lg-0">
            <li class="nav-item active d-none d-lg-block">
                <a class="nav-link font-14 text-white font-weight-bold bg-blue1 px-1"  href="/">HOME</a>
            </li>

            @if(!empty($mainMenuPc))
                @foreach($mainMenuPc as $item)
                    <li class="nav-item d-none d-lg-block dropdown position-relative">
                        <a class="nav-link text-uppercase px-2 font-14 text-white font-weight-bold" title="{{$item['name']}}" href="{{getFullUrl($item['url'])}}">{{$item['name']}}</a>
                        @if(!empty($item['children']))
                            <div class="dropdown-content position-absolute bg-blue4 float-ri">
                                @foreach($item['children'] as $value)
                                    <a class="text-uppercase px-3 py-2 d-block nav-link font-14 text-white font-weight-bold px-1" title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            @endif
            @if(!empty($mainMenuMobile))
                @foreach($mainMenuMobile as $item)
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-uppercase d-inline-block  font-14 text-white font-weight-bold " title="{{$item['name']}}" href="{{getFullUrl($item['url'])}}">{{$item['name']}}</a>
                    @if(!empty($item['children']))
                        <span class="d-inline-block text-white float-right pr-2 toggle-sub-menu pt-3"><i class="icon-chevron-down"></i></span>
                        <div class="pl-3 sub-menu" style="display: none">
                            @foreach($item['children'] as $value)
                                <a class="nav-link text-uppercase font-14 text-white font-weight-bold " title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>
                            @endforeach
                        </div>
                    @endif
                </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="bg-blue1">
        <div class="ft-content container px-lg-0 px-3 py-4">
            <div class="row">
                <div class="col-12 col-lg-4 p-0 px-lg-3">
                    <a class="mb-3 d-block" href="/">
                        {{-- <img src="{{ env('SITE_LOGO') }}" alt="logo" width="260" height="45" class="img-fluid" > --}}
                        <img src="/web/images/logo_footer.png" width="260" height="45">
                    </a>
                    <div class="m-0 font-weight-lighter text-white about-footer font-14" style="line-height: 20px;">
                        {!! getSiteSetting('site_content_footer') !!}
                    </div>
                </div>
                <div class="col-lg-2 mt-2 font-weight-lighter px-lg-2 px-0">
                    <div class="text-blue6 text-uppercase mb-3 font-16 font-weight-bold text-red">Chuyên mục</div>
                    @if(!empty($categoriesFooter))
                        @foreach($categoriesFooter as $item)
                            <p class="mb-3"><a href="{{getFullUrl($item['url'])}}" title="{{$item['name']}}" class="text-white" rel="dofollow" >{{$item['name']}}</a></p>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-3 mt-2 font-weight-lighter px-lg-2 px-0">
                    <div class="text-blue6 text-uppercase mb-3 font-16 font-weight-bold text-red">Soi kèo bóng đá</div>
                    @if(!empty($soiKeoFooter))
                        @foreach($soiKeoFooter as $item)
                            <p class="mb-3"><a href="{{getFullUrl($item['url'])}}" title="{{$item['name']}}" class="text-white" rel="dofollow" >{{$item['name']}}</a></p>
                        @endforeach
                    @endif
                </div>
                <div class="col-12 col-lg-3 mt-2 d-lg-block p-0 font-weight-lighter about-footer">
                    <div class="text-uppercase mb-3 font-16 font-weight-bold text-red">Liên hệ</div>
                    <div class="text-white font-14">
                        <p class="mb-3">Email: <a class="text-white" rel="nofollow" href="mailto:{{ getSiteSetting('site_email') }}">{{ getSiteSetting('site_email') }}</a></p>
                        <p class="mb-3">Hotline: <a  class="text-white" rel="nofollow" href="tel:{{ getSiteSetting('site_hotline') }}">{{ getSiteSetting('site_hotline') }}</a></p>
                        <p class="mb-3">Telegram: <a class="text-white" target="_blank" rel="nofollow" href="https://t.me/beautipool">@beautipool</a></p>
                    </div>
                    <div class="mb-3">
                        <a rel="nofollow" href="{{ getSiteSetting('site_youtube') }}" class="mr-2 bg-white" style="padding: 5px;border-radius:80px;"><i class="icon-youtube" style="color:#282E43;"></i></a>

                        <a  rel="nofollow" href="{{ getSiteSetting('site_twitter') }}" class="mr-2 bg-white" style="padding: 5px;border-radius:80px;"><i class="icon-twitter" style="color:#282E43;"></i></a>

                        <a  rel="nofollow" href="{{ getSiteSetting('site_facebook') }}" class="bg-white" style="padding: 5px;border-radius:80px;"><i class="icon-facebook" style="color:#282E43;"></i></a>
                    </div>
                    <a href="//www.dmca.com/Protection/Status.aspx?ID=d8703dcd-180b-4ac3-8b90-86cb5f22fe03" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca_protected_sml_120m.png?ID=d8703dcd-180b-4ac3-8b90-86cb5f22fe03"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                    @if (!IS_AMP)
                    <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                    @endif
                </div>
            </div>
        </div>
        <div class="sidebar-bottom py-3 bg-blue1 px-lg-0 footer-copyright font-14">
            <div class="container d-block d-lg-flex justify-content-between p-0">
                <ul class="d-flex px-3 px-lg-0">
                    @if(!empty($endFooter))
                        @foreach($endFooter as $item)
                            <li><a rel="nofollow" href="{{getFullUrl($item['url'])}}" title="{{$item['name']}}" class="text-white">{{$item['name']}}<span class="mx-2"></span></a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="footer-copyright"></div>
                <div class="text-white mt-3 mt-lg-0 px-3 px-lg-0">© Copyright Soikeongon 2023. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>

<div class="fixed-bottom container d-none d-lg-flex flex-column align-items-center mx-auto popup-banner catfish-banner slideInFromLeft">
    {!! getBannerPc('catfish-pc') !!}
</div>
<div class="fixed-bottom d-block d-lg-none popup-banner">
    {!! getBannerMobile('catfish-mobile') !!}
</div>
<div style="position: fixed; right: 5px; top: 400px; width: 75px; z-index: 1030">
    {!! getBannerMobile('float-mobile') !!}
</div>
<div class="float-left position-fixed left-0 popup-banner" style="top:110px;z-index:9999;">
    {!! getBannerPc('float-left-pc') !!}
</div>
<div class="float-right position-fixed right-0 popup-banner" style="top:110px;z-index:9999;right: 0">
    {!! getBannerPc('float-right-pc') !!}
</div>
<div class="float-right position-fixed bottom-0 right-0 popup-banner" style="z-index:9999;">
    {!! getBannerPc('balloon-right-pc') !!}
</div>
