@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Tác giả chuyên mục
                        <div class="card-header-actions pr-1">
                            <a href="/admin/author/update"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Tên tác giả</th>
                                <th class="text-center w-10">Bút danh</th>
                                <th class="w-15">Thông tin</th>
                                <th class="text-center w-10">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if (!empty($authors))
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td class="text-center w-5">{{ $author->id }}</td>
                                            <td class="w-15">{{ $author->name }}</td>
                                            <td class="w-15">{{ $author->pseudonym }}</td>
                                            <td class="text-center w-10">{!! $author->info !!}</td>
                                            <td class="text-center w-10">
                                                <a class="btn btn-info" href="/admin/author/update/{{$author->id}}"><svg class="c-icon"><use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use></svg></a>
                                                <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')" href="/admin/author/delete/{{$author->id}}"><svg class="c-icon"><use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use></svg></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
