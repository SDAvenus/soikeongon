@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Danh sách Banner
                        <div class="card-header-actions pr-1">
                            <a href="/admin/banner/update"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Vị trí</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($listItem)) @foreach($listItem as $item)
                                <tr>
                                    <td class="text-center">{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="/admin/banner/update/{{$item->id}}"><svg class="c-icon"><use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use></svg></a>
                                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')" href="/admin/banner/delete/{{$item->id}}"><svg class="c-icon"><use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use></svg></a>
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
