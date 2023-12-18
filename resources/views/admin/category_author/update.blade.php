@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($author) ? 'Chỉnh sửa' : 'Thêm mới'}} tác giả</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên tác giả</label>
                                                <input class="form-control" required name="name" value="{{ $author->name ?? ''}}" type="text" placeholder="Tên tác giả">
                                            </div>
                                            <div class="form-group">
                                                <label>Bút danh</label>
                                                <input class="form-control" required name="pseudonym" value="{{ $author->pseudonym ?? ''}}" type="text" placeholder="Bút danh tác giả">
                                            </div>
                                            <div class="form-group">
                                                <label>Thông tin</label>
                                                <textarea type="text" id="tiny_info" class="form-control" value="{{ $author->info ?? ''}}" name="info" placeholder="Thông tin">{{$author->info ?? ""}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_title">Meta title</label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title" value="{{ $author->meta_title ?? ''}}" placeholder="Meta title">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_description">Meta description</label>
                                                <textarea name="meta_description" class="form-control" rows="4" id="meta_description" placeholder="Meta description">{{ $author->meta_description ?? ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keyword">Meta keyword</label>
                                                <textarea name="meta_keyword" class="form-control" rows="4" id="meta_keyword" placeholder="Meta keyword">{{ $author->meta_keyword ?? ''}}</textarea>
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
                                        <label>Avatar</label>
                                        @if (!empty($author->avatar))
                                        <img src="{{ isset($author->avatar) ? url($author->avatar) : url('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                        <img style="width: 150px" src="{{getUrl('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" name="avatar" id="hd_img" value="{{ $author->avatar ?? '' }}" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Chuyên mục</label>
                                        <div id="select-multi-category-author" data-author-id="{{ $author->id ?? 0}}">

                                        </div>
                                    </div> -->
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
