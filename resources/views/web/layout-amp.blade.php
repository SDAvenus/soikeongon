<!DOCTYPE html>
<html amp itemscope itemtype="http://schema.org/WebPage" lang="vi">
<head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <meta name="google-site-verification" content="CCUj4jP1s7nLc0zMC5-x3BivdmsBchP-rOZhjWKgyLk" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if(!empty($seo_data['index']))
    <meta name="robots" content="{{$seo_data['index']}}">
    @else
    <meta name="robots" content="index, follow">
    @endif
    <title>{{$seo_data['meta_title'] ?? ''}}</title>
    @if(!empty($seo_data['meta_keyword']))
        <meta name="keywords" content="{{$seo_data['meta_keyword']}}">
    @endif
    <meta name="description" content="{{$seo_data['meta_description'] ?? ''}}">
    <link rel="canonical" href="{{$seo_data['canonical'] ?? ''}}" />

    <!-- Meta Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$seo_data['meta_title'] ?? ''}}">
    <meta property="og:description" content="{{$seo_data['meta_description'] ?? ''}}">
    @if(!empty($seo_data['site_image']))
        <meta property="og:image" content="{{getUrl($seo_data['site_image'])}}">
    @endif
    <meta property="og:url" content="{{$seo_data['canonical'] ?? ''}}">
    @if(!empty($seo_data['published_time']))
        <meta property="article:published_time" content="{{$seo_data['published_time']}}" />
    @endif
    @if(!empty($seo_data['modified_time']))
        <meta property="article:modified_time" content="{{$seo_data['modified_time']}}" />
    @endif
    @if(!empty($seo_data['updated_time']))
        <meta property="article:updated_time" content="{{$seo_data['updated_time']}}" />
    @endif

    <link rel="shortcut icon" href="{{getUrl('web/images/favicon.ico?2')}}" />
    <link rel="apple-touch-icon" href="{{getUrl('web/images/favicon.ico?2')}}" />

    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }
    </style>
    <noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }
        </style>
    </noscript>

    <style amp-custom>
        <?php
        $css = file_get_contents("web/css/amp.css");
        $remove = [
            '/@charset[\s\S]*?;/',
            '/!important/'
        ];
        $css = preg_replace($remove, '', $css);
        echo $css;
        ?>
        @stack('styles')
    </style>

    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>

    @if(!empty($schema))
        {!!$schema!!}
    @endif
</head>
<body>
{!!getSiteSetting('meta_head_amp')!!}
@include('web.header')
@yield('content')
@include('web.footer')

<?php $popup = getBanner('popup-mobile'); if ($popup):?>
<div class="position-fixed top-0 bottom-0 left-0 right-0 text-center lazy-banner-popup" style="background-color: rgba(0,0,0,0.45); z-index: 3;" id="ampPopup">
    <div class="position-relative d-block mx-auto" style="z-index: 2;margin-top: 15vh;max-width: 300px">
        <?=$popup?>
    </div>
    <div class="position-absolute top-0 bottom-0 left-0 right-0" role="button" tabindex="-1" on="tap:adsPopUp.toggleClass(class='d-none')" style="z-index: 1"></div>
</div>
<?php endif?>

</body>
</html>
