@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-2 p-lg-0">
                @if(isset($breadCrumb) && !empty($breadCrumb))
                    {!! getBreadcrumb($breadCrumb) !!}
                @endif
                @include('web.block._sidebar_i9')
                <div class="row">
                    <div class="col-12">
                        <div class="single-header">
                            <div class="font-weight-bold mb-3">{!! $oneItem->description !!}</div>
                        </div>

                        <div class="line-height-24 entry-content">
                            {!! $oneItem->content !!}
                        </div>
                    </div>
                </div>
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection
