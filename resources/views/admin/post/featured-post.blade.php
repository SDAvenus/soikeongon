@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-12">
                            <h2>Danh sách bài nổi bật</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-8">
                                <select id="get-post"></select>
                            </div>
                            <div class="col-4">
                                <button type="button" id="select-post" class="btn btn-sm btn-primary">Thêm bài viết</button>
                            </div>
                        </div>
                        <form action="" method="post" id="form-order">
                            <div class="data">
                                @foreach ($featuredPosts as $featuredPost)
                                    <div class="row post py-3" data-id="{{$featuredPost->post->id}}" data-order="{{$loop->index +1}}" data-title="{{$featuredPost->post->title}}" data-order-id="{{$featuredPost->id}}">
                                        <input type="hidden" name="featuredPost[{{$loop->index +1}}][post_id]" class="post-id" value="{{$featuredPost->post->id}}">
                                        <input type="hidden" name="featuredPost[{{$loop->index +1}}][order]" class="post-order" value="{{$loop->index +1}}">
                                        <input type="hidden" name="featuredPost[{{$loop->index +1}}][id]" class="post-order" value="{{$featuredPost->id}}">
                                        <div class="col-1 post-index">{{$loop->index +1}}</div>
                                        <div class="col-8">{{$featuredPost->post->title}}</div>
                                        <div class="col-1 post-up text-center"><a href="javascript:void(0)">Lên</a></div>
                                        <div class="col-1 post-down text-center"><a href="javascript:void(0)">xuống</a></div>
                                        <div class="col-1 post-remove text-center"><a href="javascript:void(0)">Xóa</a></div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
<script type="text/javascript">
    window.onload = function(){
        var getPost = $("#get-post");
        getPost.select2({
            ajax: {
                url: "/admin/ajax/get-posts",
                method: 'get',
                data: function (params) {
                    let page = params.page
                    return {
                        q: params.term, 
                        page: params.page
                    };
                },
                processResults: function (results, params) {
                    params.page = params.page || 1;
                    let data = [];
                    results.data.map(function(post, index){
                        data.push({
                            id: post.id,
                            text: post.title
                        })  
                    });
                return {
                    results: data,
                    pagination: {
                        more: (params.page * 30) < results.total
                    }
                };
                },
                cache: true
            },
            width: '100%',
            placeholder: 'Tìm kiếm bài viết',
            more: true
        });
        $('#select-post').on('click', function (e){
            let element = $(this),
                data = getPost.select2('data')[0],
                posts = $('.post'),
                lastPost = posts.last(),
                lastPostOrder = lastPost.data('order'),
                postOrder = 1;
            if(!(typeof(lastPostOrder) == "undefined"))
            {
                postOrder = parseInt(lastPostOrder)+1;
                console.log(postOrder);
            }
            $('#form-order .data').append(appendData(data.id, postOrder, data.text));
        });
        
        $(document).on('click', '.post-up', function () {
            let element = $(this),
                post = element.parent(),
                prevPost = post.prev(), 
                dataPost = post.data(),
                dataPrevPost = prevPost.data(),
                //swap order
                htmlPost = appendData(dataPost.id, dataPrevPost.order, dataPost.title, dataPost.orderId),
                htmlPrevPost = appendData(dataPrevPost.id, dataPost.order, dataPrevPost.title, dataPrevPost.orderId)
                //

                post.after(htmlPost+htmlPrevPost);
                post.remove();
                prevPost.remove();
        });

        $(document).on('click', '.post-down', function () {
            let element = $(this),
                post = element.parent(),
                nextPost = post.next(), 
                dataPost = post.data(),
                dataNextPost = nextPost.data(),
                //swap order
                htmlPost = appendData(dataPost.id, dataNextPost.order, dataPost.title, dataPost.orderId),
                htmlNextPost = appendData(dataNextPost.id, dataPost.order, dataNextPost.title, dataNextPost.orderId)
                //

                post.after(htmlNextPost+htmlPost);
                post.remove();
                nextPost.remove();
        });

        $(document).on('click', '.post-remove', function () {
            let element = $(this),
                html = "",
                post = element.parent(),
                data = post.data();
            post.remove();
            
            // sort order
            $('.post').each((index, element) => {
                let indexData = $(element).data();

                if(indexData.order > data.order)
                {
                    let order = indexData.order - 1; // sort order when remove
                    html += appendData(indexData.id, order, indexData.title, indexData.orderId);
                }else{
                    html += appendData(indexData.id, indexData.order, indexData.title, indexData.orderId);
                }
            });
            $('#form-order .data').html(html);
            $('#form-order').append(`<input type="hidden" name="idRemoves[]" value="${data.orderId}">`);
        });

        function appendData(postId, postOrder, title, orderId = '')
        {
            return `<div class="row post py-3" data-id="${postId}" data-order="${postOrder}" data-title="${title}" data-order-id="${orderId}">
                        <input type="hidden" name="featuredPost[${postOrder}][post_id]" class="post-id" value="${postId}">
                        <input type="hidden" name="featuredPost[${postOrder}][order]" class="post-order" value="${postOrder}">
                        <input type="hidden" name="featuredPost[${postOrder}][id]" class="post-order" value="${orderId}">
                        <div class="col-1 post-index">${postOrder}</div>
                        <div class="col-8">${title}</div>
                        <div class="col-1 post-up text-center"><a href="javascript:void(0)">Lên</a></div>
                        <div class="col-1 post-down text-center"><a href="javascript:void(0)">xuống</a></div>
                        <div class="col-1 post-remove text-center"><a href="javascript:void(0)">Xóa</a></div>
                    </div>`;
        }

    }
</script>
@endpush