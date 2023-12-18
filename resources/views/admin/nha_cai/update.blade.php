@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Nhà cái</strong> ( {{$arr_type[$type]}} )</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên nhà cái</label>
                                                <input class="form-control" required name="name" value="{{!empty($oneItem->name) ? $oneItem->name : ''}}" type="text" placeholder="Tên nhà cái">
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea id="description_nha_cai" class="form-control context" name="content[description]" rows="4" placeholder="Mô tả">{{!empty($description) ? $description : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Link cược ngay</label>
                                                <input class="form-control" name="content[link_bet]" value="{{!empty($link_bet) ? $link_bet : ''}}" type="text" placeholder="Link cược ngay">
                                            </div>
                                            <div class="form-group">
                                                <label>Link xem review</label>
                                                <input class="form-control" name="content[link_review]" value="{{!empty($link_review) ? $link_review : ''}}" type="text" placeholder="Link xem review">
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
                                        <label>Logo nhà cái</label>
                                        @if(!empty($logo))
                                            <img src="{{$logo}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{getUrl('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" id="hd_img" name="content[logo]" value="{{!empty($logo) ? $logo: ''}}" required>
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
