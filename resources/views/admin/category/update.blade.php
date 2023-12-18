@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} chuyên mục</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <input class="form-control" required name="title" value="{{!empty($oneItem->title) ? $oneItem->title : ''}}" type="text" placeholder="Tiêu đề">
                                            </div>
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input class="form-control" required name="slug" value="{{!empty($oneItem->slug) ? $oneItem->slug : ''}}" type="text" placeholder="Slug">
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea id="tiny-featured" class="form-control" rows="4" name="description" placeholder="Mô tả">{{!empty($oneItem->description) ? $oneItem->description : ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Nội dung</label>
                                                <textarea id="full-featured" class="form-control" name="content">{{!empty($oneItem->content) ? $oneItem->content : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>Chuyên mục cha</label>
                                            <select class="form-control" name="parent_id">
                                                <option value="0">Lựa chọn</option>
                                                @foreach($categoryTree as $item)
                                                    <option value="{{$item['id']}}" {{!empty($oneItem) && $item['id'] == $oneItem->parent_id? 'selected': ''}}>{{$item['title']}}</option>
                                                @endforeach
                                            </select>
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
                                        <label>Thumbnail</label>
                                        @if(!empty($oneItem->thumbnail))
                                            <img src="{{$oneItem->thumbnail}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{getUrl('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" name="thumbnail" id="hd_img" value="{{!empty($oneItem->thumbnail)? $oneItem->thumbnail: ''}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề SEO</label>
                                        <input class="form-control" name="meta_title" value="{{!empty($oneItem->meta_title) ? $oneItem->meta_title : ''}}" type="text" placeholder="Tiêu đề SEO">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả SEO</label>
                                        <textarea class="form-control" name="meta_description" rows="4" placeholder="Mô tả SEO">{{!empty($oneItem->meta_description) ? $oneItem->meta_description : ''}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa SEO</label>
                                        <input class="form-control" name="meta_keyword" value="{{!empty($oneItem->meta_keyword) ? $oneItem->meta_keyword : ''}}" type="text" placeholder="Từ khóa SEO">
                                    </div>
                                    <div class="form-group">
                                        <label>Thứ tự</label>
                                        <input class="form-control" name="order_by" value="{{!empty($oneItem->order_by) ? $oneItem->order_by : 0}}" type="number" placeholder="Thứ tự" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="form-control">
                                            <option {{isset($oneItem->status) && $oneItem->status == 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                                            <option {{isset($oneItem->status) && $oneItem->status == 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                                        </select>
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
