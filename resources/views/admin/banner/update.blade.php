@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Banner</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Vị trí</label>
                                                <input class="form-control" required name="title" value="{{!empty($oneItem->title) ? $oneItem->title : ''}}" type="text" placeholder="Vị trí">
                                            </div>
                                            <div class="form-group">
                                                <label>Nội dung</label>
                                                <textarea class="form-control" rows="15" name="content">{{!empty($oneItem->content) ? $oneItem->content : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary">Lưu trữ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
