@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-lg-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="d-block d-lg-none">
                @if(isset($breadCrumb) && !empty($breadCrumb))
                    {!! getBreadcrumb($breadCrumb) !!}
                @endif
            </div>
            <div class="main-content mt-2 mt-lg-4 mr-lg-4 p-3 p-lg-0">
                @if(!empty($listNhaCai))
                <div class="mb-2 d-flex align-items-center flex-wrap">
                    <span class="text-title line-height-23 font-20 text-red font-weight-bold position-relative pl-4 text-uppercase w-100 mb-3">Top nhà cái uy tín tặng tiền cược miễn phí 2023</span>
                    <p class="mb-0 font-16 font-weight-bold w-100">
                        Soikeongon xin giới thiệu đến bạn danh sách top 20 nhà cái uy tín được người dùng bình chọn. Đây là những nhà cái cá cược có nhiều người chơi nhất hiện nay. Chúng tôi sẽ liên tục cập nhật thông tin khuyến mãi, link truy cập nhà cái mới chuyên mục viết này.
                    </p>
                </div>
                    @include('web.block._nha_cai', ['listNhaCai' => $listNhaCai])
                @endif
                @if(!empty($oneItem->description))
                <div class="cat_des text-justify font-16 mb-3">
                    {!! $oneItem->description !!}
                </div>
                @endif
                <div class="top-20-nha-cai">
                    <div class="title-top-20 pt-5">
                        <h3 class="text-black2 font-32 font-weight-bold">
                            TOP 20 nhà cái uy tín nhất trên thị trường hiện nay
                        </h3>
                        <p class="mb-0">
                            Trong bối cảnh mức sống của con người ngày càng được cải thiện, nhu cầu vui chơi giải trí cũng vì thế mà tăng theo. Bên cạnh hoạt động thể thao ngoài trời cùng bạn bè hay cùng nhau chơi vài ván trò chơi điện tử thì cá cược thể thao và cá cược Esports đang dần trở thành một món ăn tinh thần không thể thiếu của những tín đồ của các lĩnh vực này. Nhiều người thậm chí còn cho rằng có thêm yếu tố cá cược sẽ giúp việc theo dõi những cuộc so tài trong các môn thể thao đơn thuần trở nên bớt nhàm chán và có vị hơn.
Thấu hiểu nhu cầu trên của người hâm mộ nhiều tập đoàn cá cược đã được thành lập trên thế giới. Cộng hưởng với sự phát triển của công nghệ thông tin và mong muốn đưa những sản phẩm của mình tớivới số lượng lớn người chơi trên toàn thế giới, những tập đoàn này đã lần lượt cho ra mắt nền tảng cá cược và giải trí trực tuyến (online) của mình. Người chơi giờ đây chỉ cần một thiết bị có kết nối Internet (Máy tính hoặc điện thoại) là có thể trải nghiệm hoạt động cá cược đầy thú vị ngay tại nhà.
Không chỉ dừng lại ở bộ môn cá cược, Casino trực tuyến cũng là một sản phẩm mà mọi nhà cái đều đầu tư phát triển. Dựa trên việc đánh giá chất lượng của mảng cá cược lẫn mảng Casino trực tuyến, cùng với các chương trình khuyến mãi thưởng lớn, tốc độ rút nạp,...soikeo247 đề xuất danh sách top 10 nhà cái uy tín nhất trên thị trường hiện nay. Từ đó người chơi có thể có được cái nhìn trực quan hơn về các nhà đang hoạt động ở thời điểm này và chọn ra được cho mình một địa chỉ đáng tin cậy và chất lượng để chọn mặt gửi vàng.
                        </p>
                    </div>
                    <div class="nha-cai-item py-5">
                        <h3 class="text-red font-32 font-weight-bold">
                            TOM88
                        </h3>
                        <p>Với hơn 10 năm hoạt động trong ngành cá cược và đạt được những thành tựu đáng mơ ước với mọi nhà cái, M88 (Mansion 88) được coi là một trong những nhà cái lỗi lạc của thị trường châu Á và Việt Nam. Mọi hoạt động của M88 là hoàn toàn hợp pháp, được cấp phép bởi chính phủ Philippines và đặt trụ sở của mình tại thủ đô Manila.
                            Mảng mạnh nhất của M88 chính là cá cược thể thao, mà cụ thể là cá độ bóng đá với số lượng kèo khổng lồ, tỷ lệ kèo đa dạng và có thể được coi là hấp dẫn nhất trong làng cá cược. Bởi vậy M88 luôn được các "cá thủ" đánh giá là sự lựa chọn số 1. Việc M88 đạt được những thành tựu này cũng không phải là một điều gì đó quá khó hiểu nếu biết rằng M88 chính là một trong những cái tên đi đầu trong lĩnh vực cá cược tại Việt Nam.</p>
                    </div>
                </div>
                <div class="list-more-posts">
                    @include('web.block._load_more_post', ['post' => $post])
                </div>
                <div class="my-3">
                    <a href="#" data-catid="{{$oneItem->id ?? 0}}" data-page="{{$page ?? null}}" class="btn-cat-load-more d-block text-black border p-2 text-center font-weight-bold">
                        Xem thêm
                    </a>
                </div>
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection
