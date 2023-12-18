@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} top
                                        game</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên game</label>
                                                <input class="form-control" required name="name"
                                                       value="{{!empty($oneItem->name) ? $oneItem->name : ''}}"
                                                       type="text" placeholder="Tên nhà cái">
                                            </div>
                                            @php

                                                if(empty($home_feature)) $home_feature = null;
                                            @endphp
                                            <div class="form-group hide d-none">
                                                <label>Game nổi bật trang chủ</label>
                                                <select name="content[rate]" class="form-control">
                                                    <option value="null"
                                                            {{$home_feature == null ? 'selected' : ''}} class="text-danger">
                                                        Không
                                                    </option>
                                                    <option value="1"
                                                            {{$home_feature != null ? 'selected' : ''}} class="text-success">
                                                        Có
                                                    </option>
                                                </select>
                                            </div>
                                            @php
                                                if(empty($rate)) $rate = 5;
                                            @endphp
                                            <div class="form-group">
                                                <label>Đánh giá sao</label>
                                                <select name="content[rate]" class="form-control">
                                                    <option value="1" {{$rate == 1 ? 'selected' : ''}}>1</option>
                                                    <option value="1.5" {{$rate == 1.5 ? 'selected' : ''}}>1.5</option>
                                                    <option value="2" {{$rate == 2 ? 'selected' : ''}}>2</option>
                                                    <option value="2.5" {{$rate == 2.5 ? 'selected' : ''}}>2.5</option>
                                                    <option value="3" {{$rate == 3 ? 'selected' : ''}}>3</option>
                                                    <option value="3.5" {{$rate == 3.5 ? 'selected' : ''}}>3.5</option>
                                                    <option value="4" {{$rate == 4 ? 'selected' : ''}}>4</option>
                                                    <option value="4.5" {{$rate == 4.5 ? 'selected' : ''}}>4.5</option>
                                                    <option value="5" {{$rate == 5 ? 'selected' : ''}}>5</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea class="form-control" name="content[description]" type="text"
                                                          placeholder="Mô tả">{{!empty($description) ? $description : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Link xem review</label>
                                                <input class="form-control" name="content[link]"
                                                       value="{{!empty($link) ? $link : ''}}" type="text"
                                                       placeholder="Link xem review">
                                            </div>

                                            <div class="form-group">
                                                <label>Link xem cược ngay</label>
                                                <input class="form-control" name="content[link_cuocngay]"
                                                       value="{{!empty($link_cuocngay) ? $link_cuocngay : ''}}"
                                                       type="text" placeholder="Link xem cược ngay">
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
                                        <label>Logo</label>
                                        @if(!empty($logo))
                                            <img src="{{$logo}}" id="lbl_img" class="img-fluid d-block"
                                                 onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{url('admin/images/no-image.jpg')}}" id="lbl_img"
                                                 class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" id="hd_img" name="content[logo]"
                                               value="{{!empty($logo) ? $logo: ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input class="form-control" name="order_by"
                                               value="{{!empty($oneItem->order_by) ? $oneItem->order_by : 0}}"
                                               type="number" placeholder="Thứ tự" min="0">
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
    <script defer src="/admin/js/nestable/top_game.js?{{time()}}"></script>
@endsection
