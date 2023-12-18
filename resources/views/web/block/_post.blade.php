
@if ($posts->count())
<div class="aside-box mb-3">
    <div class="font-20 font-weight-bold mb-2 d-flex align-items-center">
        <span class="square-blue mr-2"></span>
        <a href="{{getUrlCate($posts[0]->category)}}">
            <span class="text-title">
                {{$title}}
            </span>
        </a>
    </div>
    @if(isset($firstPost))
        @php
            $post = $posts[0];
            unset($posts[0]);
        @endphp
        <div class="post-card px-2">
            <a class="d-block mb-2" href="{{ getUrlPost($post) }}">
                {!! genImage($post->thumbnail, 400, 250, $post->title, 'img-fluid') !!}
                <div class="post-card-body font-14 text-dark mt-2">
                    <h3 class="font-16 text-dark  font-weight-bold line-height-24">{{$post->title}}</h3>
                    @if(isset($fullDes))
                        {!!$post->description!!}
                    @else
                        {!! get_limit_content($post->description, 245) !!}
                    @endif
                </div>
            </a>
        </div>
    @endif
    <div class="mx-2">
        @foreach ($posts as $post)
            <div class="row mb-3">
                <div class="col-5 pr-0">
                    <a href="{{ getUrlPost($post) }}">{!! genImage($post->thumbnail, 150, 90, $post->title, 'img-fluid') !!}</a>
                </div>
                <div class="col-7">
                    <a href="{{ getUrlPost($post) }}" class="text-black font-description">{{ $post->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
