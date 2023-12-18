@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Danh sách Tag
                        <div class="card-header-actions pr-1">
                            <a href="/admin/tag/update"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="">
                            <div class="form-group row">
                                <div class="col-4">
                                    <input type="text" value="{{$_GET['keyword'] ?? ''}}" name="keyword" class="form-control" placeholder="Từ khóa">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-success" value="Tìm kiếm">
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Tiêu đề</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($listItem)) @foreach($listItem as $item)
                            <tr>
                                <td class="text-center">{{$item->id}}</td>
                                <td><a target="_blank" href="{{getUrlTag($item)}}">{{$item->title}}</a></td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="/admin/tag/update/{{$item->id}}">
                                        <svg class="c-icon">
                                            <use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                       href="/admin/tag/delete/{{$item->id}}">
                                        <svg class="c-icon">
                                            <use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach @endif
                            </tbody>
                        </table>
                        <ul class="pagination">
                            @if (!$listItem->onFirstPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{$listItem->previousPageUrl()}}">Prev</a>
                                </li>
                            @endif
                            @foreach ($listItem->links()->elements as $element)
                                @if (is_string($element))
                                    <li class="page-item">
                                        {{ $element }}
                                    </li>
                                @endif
                                @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            <li class="page-item @if($page == $listItem->currentPage()) active @endif">
                                                <a class="page-link" href="{{$url}}">{{$page}}</a>
                                            </li>
                                        @endforeach
                                @endif
                            @endforeach
                            @if ($listItem->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{$listItem->nextPageUrl()}}">Next</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
