@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Thông tin trang</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tiêu đề trang</label>
                                                <input class="form-control" name="site_title" value="{{!empty($oneItem->site_title) ? $oneItem->site_title : ''}}" type="text" placeholder="Tiêu đề trang">
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả trang</label>
                                                <textarea class="form-control" name="site_description" rows="4" placeholder="Mô tả trang">{{!empty($oneItem->site_description) ? $oneItem->site_description : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Thông tin trang</label>
                                                <textarea id="tiny-featured" class="form-control" name="site_content" rows="4" placeholder="Thông trang">{{!empty($oneItem->site_content) ? $oneItem->site_content : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Thông tin Footer</label>
                                                <textarea class="form-control context" name="site_content_footer" rows="4" placeholder="Thông tin Footer">{{!empty($oneItem->site_content_footer) ? $oneItem->site_content_footer : ''}}</textarea>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Email</label>
                                                    <input class="form-control" name="site_email" value="{{!empty($oneItem->site_email) ? $oneItem->site_email : ''}}" type="text" placeholder="Email">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Hotline</label>
                                                    <input class="form-control" name="site_hotline" value="{{!empty($oneItem->site_hotline) ? $oneItem->site_hotline : ''}}" type="text" placeholder="Hotline">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Youtube</label>
                                                    <input type="text" class="form-control" name="site_youtube" value="{{!empty($oneItem->site_youtube) ? $oneItem->site_youtube : ''}}" placeholder="Youtube" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Twitter</label>
                                                    <input type="text" class="form-control" name="site_twitter" value="{{!empty($oneItem->site_twitter) ? $oneItem->site_twitter : ''}}" placeholder="Twitter" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control" name="site_facebook" value="{{!empty($oneItem->site_facebook) ? $oneItem->site_facebook : ''}}" placeholder="Facebook" >
                                                </div>
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
                                        @if(!empty($oneItem->site_logo))
                                            <img src="{{$oneItem->site_logo}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{getUrl('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" id="hd_img" name="site_logo" value="{{!empty($oneItem->site_logo)? $oneItem->site_logo: ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tiêu đề logo:</label>
                                        <input type="text" class="form-control" name="site_logo_title" value="{{!empty($oneItem->site_logo_title)? $oneItem->site_logo_title: ''}}" placeholder="Tiêu đề logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alt logo:</label>
                                        <input type="text" class="form-control" name="site_logo_alt" value="{{!empty($oneItem->site_logo_alt)? $oneItem->site_logo_alt: ''}}" placeholder="Alt logo ">
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
