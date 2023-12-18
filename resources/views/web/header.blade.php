<div id="fb-root"></div>
<header>
    <div class="container p-0 px-lg-3 pb-5 pb-lg-5">
        <div class="pl-3 d-none d-lg-flex header-banner justify-content-between align-items-center" style="height: 110px;">
            <a href="/">
                <img src="/images/logo.png" width="260" height="45">
            </a>
        </div>
    </div>
</header>
<div class="mt-n5 nav-menu position-sticky px-0 px-lg-3 bg-red">
    <nav class="container navbar navbar-expand-lg m-auto px-lg-3 p-0 nav-menu position-sticky justify-content-between">
        <div class="header-mobile-top d-flex w-100 d-lg-none d-flex py-3">
            <button class="navbar-toggler border-0 m-0 p-0 col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" @if (IS_AMP) on="tap:navbarSupportedContent.toggleClass(class='show')" @endif>
                <span class="navbar-toggler-icon"><img src="/web/images/button-menu-mobile.png" width="24" height="18"/></span>
            </button>
            <a class="navbar-brand navbar-toggler border-0 m-0 p-0 col-8 d-flex justify-content-center" href="/">
                <img src="../web/images/logo-header-mobile.png" width="130" height="23">
            </a>
            <div class="col-2"></div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 d-flex justify-content-between mb-0 bg-red">
                <li class="nav-item @if($_SERVER['REQUEST_URI'] == '/') active @endif  d-none d-lg-block">
                    <a class="nav-link font-14 text-white font-weight-bold"  href="/">HOME</a>
                </li>

                @if(!empty($mainMenuPc))
                    @foreach($mainMenuPc as $item)
                        <li class="nav-item d-none d-lg-block dropdown position-relative  @if( $_SERVER['REQUEST_URI'] == $item['url'])) active @endif">
                            <a class="nav-link text-uppercase px-2 font-14 text-white font-weight-bold" title="{{$item['name']}}" href="{{getFullUrl($item['url'])}}">{{$item['name']}}</a>
                            @if(!empty($item['children']))
                                <div class="dropdown-content position-absolute bg-blue4 float-ri">
                                    @foreach($item['children'] as $value)
                                        <a class="text-uppercase px-3 py-2 d-block nav-link font-14 text-white font-weight-bold" title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                @endif

                @if(!empty($mainMenuMobile))
                    @foreach($mainMenuMobile as $item)
                    <li class="nav-item d-lg-none px-4 px-lg-0 border-menu-mobile">
                        <a class="nav-link text-uppercase d-inline-block  font-14 text-white font-weight-bold" title="{{$item['name']}}" href="{{getFullUrl($item['url'])}}">{{$item['name']}}</a>
                        @if(!empty($item['children']))
                            <span class="d-inline-block text-white float-right pr-2 pt-3 toggle-sub-menu"><i class="icon-simple-right"></i></span>
                            <div class="pl-3 sub-menu" style="display: none">
                                @foreach($item['children'] as $value)
                                    <a class="nav-link text-uppercase font-14 text-white font-weight-bold" title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                    @endforeach
                @endif
            </ul>
            <ul class="d-flex d-lg-none align-items-center flex-wrap font-13 bar-mobi  mb-0 px-4 bg-blue1 pb-4">
                @if(!empty($trendingMobile))
                    @foreach($trendingMobile as $item)
                        <li class="w-100 py-1"><a href="{{getFullUrl($item['url'])}}" class="text-white font-14 mr-2" title="{{$item['name']}}">{{$item['name']}}</a></li>
                    @endforeach
                @endif
            </ul>
        </div>
    </nav>
</div>
<div class="d-lg-none list-banner-mobi">
    <?php echo getBanner('header-mobile')?>
</div>
<div class="p-0 px-lg-3 d-none d-lg-block bg-blue1">
    <div class="container trending-topic d-flex h30  justify-content-between align-items-center font-14 px-2">
        <ul class="d-flex font-weight-thin flex-wrap w-100 justify-content-around mb-0 pl-0">
            @if(!empty($trendingPc))
                @foreach($trendingPc as $item)
                <li>
                    <a href="{{getFullUrl($item['url'])}}" class="text-white" title="{{$item['name']}}">{{$item['name']}}</a>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
<div class="container px-3 popup-banner d-none d-lg-block">
    {!! getBannerPC('full-width-pc', 'row mx-0 row-cols-2') !!}
</div>

