@php $ver = '0.3' @endphp
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="{{$seo_data['index'] ?? ''}}">
    <meta name='dmca-site-verification' content='R0xEbjBHb0l2NnlFelkxOHBtSjJCQT090' />
    <title>{{$seo_data['meta_title'] ?? ''}}</title>
    @if(!empty($seo_data['meta_keyword']))
        <meta name="keywords" content="{{$seo_data['meta_keyword']}}">
    @endif
    <meta name="description" content="{{$seo_data['meta_description'] ?? ''}}">
    <link rel="canonical" href="{{$seo_data['canonical'] ?? ''}}" />
    <meta property="og:title" content="{{$seo_data['meta_title'] ?? ''}}">
    @if(!empty($seo_data['site_image']))
        <meta property="og:image" content="{{$seo_data['site_image']}}">
    @endif
{{--    @if(!empty($seo_data['amphtml']))--}}
{{--        <link rel="amphtml" href="{{$seo_data['amphtml']}}">--}}
{{--    @endif--}}
    <meta property="og:site_name" content="{{ env('DOMAIN') }}">
    <meta property="og:description" content="{{$seo_data['meta_description'] ?? ''}}">
    @if(!empty($seo_data['published_time']))
        <meta property="article:published_time" content="{{$seo_data['published_time']}}" />
    @endif
    @if(!empty($seo_data['modified_time']))
        <meta property="article:modified_time" content="{{$seo_data['modified_time']}}" />
    @endif
    @if(!empty($seo_data['updated_time']))
        <meta property="article:updated_time" content="{{$seo_data['updated_time']}}" />
    @endif
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{$seo_data['meta_title'] ?? ''}}" />
    <meta name="twitter:description" content="{{$seo_data['meta_description'] ?? ''}}" />
    @if(!empty($seo_data['site_image']))
        <meta name="twitter:image" content="{{getUrl($seo_data['site_image'])}}" />
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="shortcut icon" href="{{getUrl('images/favicon.png')}}" />
    <link rel="apple-touch-icon" href="{{getUrl('images/favicon.png')}}" />

    <script defer src="/web/js/jquery.min.js"></script>
    <script defer src="/web/js/non-critical.js?5"></script>
    <script defer src="/web/js/custom.js?3.4"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2KF2HY9YWE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2KF2HY9YWE');
    </script>
    @if (isset($pagePost) && $pagePost == true)
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "headline": "{{$oneItem->title ?? ""}}",
      "description": "{{$seo_data['meta_description'] ?? ''}}",
      "image": [
@if (!empty($img))
    @foreach($img as $key => $item)
    @if($key != (count($img) - 1))
"{{$item}}",
@else
"{{$item}}"
@endif
    @endforeach
@endif
   ],
      "datePublished": "{{$seo_data['published_time'] ?? ""}}",
      "dateModified": "{{$seo_data['modified_time'] ?? ""}}",
      "author": [{
        "@type": "Person",
        "name": "{{$oneItem->name_author ?? ""}}",
    @if (!empty($oneItem->author_slug) && !empty($oneItem->author_id))
    "url": "{{route('author_post', ['slug' => $oneItem->author_slug, 'id' => $oneItem->author_id])}}"
    @endif
    }]
    }
    </script>
    @endif
    <style>
        {!!file_get_contents('web/css/critical.css').file_get_contents('web/css/non-critical.css');!!}
        @stack('styles')
    </style>
    @if(!empty($schema))
        {!!$schema!!}
    @endif
</head>
<body>
@include('web.header')
@yield('content')
@include('web.footer')

<!--banner preload-->
@if (IS_MOBILE)
    @php $popup = getBanner('popup-mobile') @endphp
@else
    @php $popup = getBanner('popup-pc'); @endphp
@endif
@if ($popup)
<div id="adsModal" class="modal fade" role="dialog" style="margin-top: 100px">
    <div class="modal-dialog">
        <div class="modal-content" style="background: none;box-shadow: none;border: none;">
            <div class="modal-body mx-auto">
                <div class="d-lg-none text-center" style="max-width: 300px">
                    {!! $popup !!}
                </div>
                <div class="d-none d-lg-block text-center">
                    {!! $popup !!}
                </div>
                <span style="right: 14px;width: 30px;text-align: center;background: rgba(169,169,169,0.8);" class="d-none p-2 position-absolute" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</div>
@endif

<script >
    let is_mobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
    let urlAdsMb = `{{ getBanner('popunder-mobile') }}`;
    let urlAdsPc = `{{ getBanner('popunder-pc') }}`;
    if ((urlAdsMb && is_mobile) || (urlAdsPc && !is_mobile)) {
        document.addEventListener('DOMContentLoaded', function () {
            let key = 'checkPopunder';
            let executed = false;

            if (!sessionStorage.getItem(key)) {
                sessionStorage.setItem(key, 1);
                $(document).on('click', 'a:not([target="_blank"][rel="nofollow"])', function (e) {
                    if (!executed) {
                        executed = true;
                        e.preventDefault();
                        openTab(this);
                    }
                });
            }

        });

        function openTab(_this) {
            _this = $(_this);
            let currentUrl = _this.attr('href');
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                window.open(currentUrl, "_blank");
                window.location = urlAdsMb;
            } else {
                window.open(currentUrl, "_blank");
                window.location = urlAdsPc;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        $('.popup-banner').on('click', '.banner-close', function (e) {
            $(this).closest('.popup-banner').remove();
        });

        $('#adsModal').on('click', '.banner-close', function (e) {
            $('#adsModal').modal('hide');
        });

    });
</script>

@stack('scripts')

</body>
</html>
