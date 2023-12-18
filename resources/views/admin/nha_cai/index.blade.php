@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Danh sách Nhà cái
                        <div class="card-header-actions pr-1">
                            <a href="/admin/nha_cai/update/{{$type}}"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">
                                <select class="form-control" name="category_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="/admin/nha_cai/1" {{$type == 1 ? 'selected' : ''}}>Sidebar</option>
                                    <option value="/admin/nha_cai/2" {{$type == 2 ? 'selected' : ''}}>Chuyên mục nhà cái</option>
                                </select>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">Thứ tự</th>
                                <th>Tên nhà cái</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($listItem)) @foreach($listItem as $item)
                                <tr>
                                    <td class="text-center">{{$item->order_by}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="/admin/nha_cai/update/{{$type}}/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use>
                                            </svg>
                                        </a>
                                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                           href="/admin/nha_cai/delete/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
