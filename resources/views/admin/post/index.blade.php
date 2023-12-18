@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Danh sách bài viết {{ !empty($_GET['is_soikeo']) ? 'soi kèo ' : '' }}({{$total}})
                        <div class="card-header-actions pr-1">
                            <a href="/admin/post/update{{ !empty($_GET['is_soikeo']) ? '?is_soikeo=1' : '' }}"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="">
                            <div class="form-group row">
                                <div class="col-2">
                                    <select class="form-control sl-type-post">
                                        <option @if(isset($_GET['status']) && $_GET['status'] == 1) selected @endif value="/admin/post?status=1{{ !empty($_GET['is_soikeo']) ? '&is_soikeo=1' : '' }}">Bài đã xuất bản</option>
                                        <option @if(isset($_GET['hen_gio']) && $_GET['hen_gio'] == 1) selected @endif value="/admin/post?status=1&hen_gio=1{{ !empty($_GET['is_soikeo']) ? '&is_soikeo=1' : '' }}">Bài hẹn giờ</option>
                                        <option @if(isset($_GET['status']) && $_GET['status'] == 0) selected @endif value="/admin/post?status=0{{ !empty($_GET['is_soikeo']) ? '&is_soikeo=1' : '' }}">Bài nháp</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" value="{{$_GET['keyword'] ?? ''}}" name="keyword" class="form-control" placeholder="Từ khóa">
                                </div>
                                <div class="col-2">
                                    <select name="category_id" class="form-control">
                                        <option value="">Chuyên mục</option>
                                        @foreach($categoryTree as $item)
                                            <option value="{{$item['id']}}" {{!empty($_GET['category_id']) && $item['id'] == $_GET['category_id'] ? 'selected': ''}}>{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($group_id == 1)
                                <div class="col-2">
                                    <select name="user_id" class="form-control">
                                        <option value="">Thành viên</option>
                                        @foreach($listUser as $item)
                                            <option value="{{$item['id']}}" {{!empty($_GET['user_id']) && $item['id'] == $_GET['user_id'] ? 'selected': ''}}>{{$item['username']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <input type="hidden" name="status" value="{{$_GET['status']}}">
                                <input type="hidden" name="is_soikeo" value="{{$_GET['is_soikeo'] ?? ''}}">
                                @if(isset($_GET['hen_gio']))
                                    <input type="hidden" name="hen_gio" value="{{$_GET['hen_gio']}}">
                                @endif
                                <div class="col-2">
                                    <input type="submit" class="btn btn-success" value="Tìm kiếm">
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th class="text-center w-30">Tiêu đề</th>
                                <th class="text-center w-10">Chuyên mục</th>
                                <th class="text-center w-10">Ngày đăng bài</th>
                                <th class="text-center w-10">Số từ</th>
                                <th class="text-center w-10">Điểm SEO</th>
                                <th class="text-center w-10">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($listItem)) @foreach($listItem as $item)
                                <tr>
                                    <td class="text-center align-middle">{{$item->id}}</td>
                                    <td class="align-middle"><a target="_blank" rel="nofollow" href="{{getUrlPost($item)}}">{!! $item->title !!}</a></td>
                                    <td class="text-center align-middle">{{$categoryTree[$item->category_id]['title'] ?? ''}}</td>
                                    <td class="text-center align-middle">{{date('d-m-Y H:i', strtotime($item->displayed_time))}}</td>
                                    <td class="text-center align-middle">{{$item->word_count ?? ''}}</td>
                                    <td class="text-center align-middle"><span class="@if(empty($item->seo_score)) @elseif($item->seo_score <= 60) bg-danger @elseif($item->seo_score >= 61 && $item->seo_score <= 89) bg-warning @else bg-success @endif text-white p-2">{{$item->seo_score ?? ''}}</span></td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="/admin/post/update/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use>
                                            </svg>
                                        </a>
                                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                           href="/admin/post/delete/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach @endif
                            </tbody>
                        </table>
                        @php init_cms_pagination($page, $pagination) @endphp
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
