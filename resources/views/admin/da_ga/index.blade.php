@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Bài viết đá gà
                        <div class="card-header-actions pr-1">
                            <a href="/admin/post/da-ga/update"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-2">
                                <select class="form-control sl-type-post">
                                    <option @if(!isset($_GET['status'])) selected @endif value="/admin/post/da-ga">Đã đăng</option>
                                    <option @if(isset($_GET['status']) && $_GET['status'] == 0) selected @endif value="/admin/post/da-ga?status=0">Lưu nháp</option>
                                </select>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Tiêu đề</th>
                                <th class="text-center w-15">Ngày đăng bài</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($listItem)) @foreach($listItem as $item)
                            <tr>
                                <td class="text-center">{{$item->id}}</td>
                                <td><a target="_blank" rel="nofollow" href="{{getUrlPostDaGa($item)}}">{{$item->title}}</a></td>
                                <td class="text-center">{{date('d-m-Y H:i', strtotime($item->displayed_time))}}</td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="/admin/post/da-ga/update/{{$item->id}}">
                                        <svg class="c-icon">
                                            <use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                       href="/admin/post/da-ga/delete/{{$item->id}}">
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
                            @foreach ($listItem->toArray()['links'] as $link )
                                @if (!$link['url'])
                                    @continue
                                @endif
                                @php
                                    $link['label'] = str_replace('pagination.previous', 'Prev', $link['label']);
                                    $link['label'] = str_replace('pagination.next', 'Next', $link['label']);
                                @endphp
                                <li class="page-item {{$link['active'] ? 'active' : ''}}">
                                    <a class="page-link" href="{{$link['url']}}">{{$link['label']}}</a>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
