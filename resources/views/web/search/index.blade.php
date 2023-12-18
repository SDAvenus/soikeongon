@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-lg-3">
    <div class="d-block d-lg-flex justify-content-between">
        <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-2 p-lg-0">
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
            <div class="col-sm-12">
                <h3> Kết quả cho từ khóa : <strong>{{$keyword}}</strong></h3>
            </div>
            <div class="list-more-posts">
                @include('web.block._load_more_post', ['post' => $posts])
            </div>
            <div class="my-3">
                <a href="#" data-keyword="{{$keyword ?? null}}" data-page="{{$page ?? null}}" class="btn-cat-load d-block bg-grey text-dark p-2 text-center">
                    Tải thêm bài viết
                </a>
            </div>
        </div>
        @include('web.block._sidebar')
    </div>
</div>
@endsection
