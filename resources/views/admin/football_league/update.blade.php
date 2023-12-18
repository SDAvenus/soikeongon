@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Giải bóng đá nổi bật</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên giải</label>
                                                <input class="form-control" required name="title" value="{{!empty($oneItem->title) ? $oneItem->title : ''}}" type="text" placeholder="Tên giải">
                                            </div>
                                            <div class="form-group">
                                                <label>Link giải</label>
                                                <input class="form-control" name="link" value="{{!empty($oneItem->link) ? $oneItem->link : ''}}" type="text" placeholder="Link giải">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header"><strong>Thông tin khác</strong></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Logo giải</label>
                                        @if(!empty($oneItem->thumbnail))
                                            <img src="{{$oneItem->thumbnail}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{getUrl('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" id="hd_img" name="thumbnail" value="{{!empty($oneItem->thumbnail) ? $oneItem->thumbnail: ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input class="form-control" name="order_by" value="{{!empty($oneItem->order_by) ? $oneItem->order_by : 0}}" type="number" placeholder="Thứ tự" min="0">
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Lưu trữ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
