@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        @if(isset($breadcrumb) && !empty($breadcrumb))
            {!! getBreadcrumb($breadcrumb) !!}
        @endif
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-lg-0 mr-lg-4 p-lg-0">
                <div class="w-100 d-none d-lg-block" style="border: 1px solid #DBDBDB;"></div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="single-header">
                            <h1 class="font-30 font-weight-bold">{{$oneItem->title}}</h1>
                            <div class="font-weight-bold font-14 mb-3">{!! $oneItem->description !!}</div>
                        </div>
                        <div class="line-height-24 entry-content">
                            {!! tableOfContent($oneItem->content) !!}
                        </div>
                    </div>
                </div>
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection
