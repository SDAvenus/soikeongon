<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none font-weight-bold">
        SOIKEONGON CMS
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/home">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-speedometer"></use>
                </svg>
                Dashboard
            </a>
        </li>
        @if(!empty($permission['category']))
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-list"></use>
                </svg>
                Quản lý Chuyên mục
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/category"><span class="c-sidebar-nav-icon"></span> Danh sách</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/category/update"><span class="c-sidebar-nav-icon"></span> Thêm mới</a></li>
            </ul>
        </li>
        @endif
        @if(!empty($permission['post']))
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown @if(getCurrentController() == 'post') c-show @endif">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-description"></use>
                </svg>
                Quản lý Bài viết
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link @if(!empty($_GET['is_soikeo'])) c-active @endif" href="/admin/post?status=1&is_soikeo=1"><span class="c-sidebar-nav-icon"></span> Bài viết soi kèo</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ request()->is('admin/post') && !isset($_GET['is_soikeo']) ? 'c-active' : '' }}" href="/admin/post?status=1"><span class="c-sidebar-nav-icon"></span> Bài viết thường</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link {{ request()->is('admin/post/da-ga') ? 'c-active' : '' }}" href="/admin/post/da-ga"><span class="c-sidebar-nav-icon"></span> Bài viết đá gà </a></li>
            </ul>
        </li>
        @endif
        @if(!empty($permission['page']))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/page?status=1">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-notes"></use>
                    </svg>
                    Quản lý Page tĩnh
                </a>
            </li>
        @endif
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/bai-viet-noi-bat">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-bank"></use>
                </svg>
                Bài viết nổi bật Trang chủ
            </a>
        </li>
        @if(!empty($permission['post']))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link"
                   href="#"
                   onclick="MyWindow=window.open('/admin/libraries/elfinder/file-elfinder.php?mode=chosefile&control=img','MyWindow','width=800,height=600'); return false;">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-image-plus"></use>
                    </svg>
                    Quản lý Media
                </a>
            </li>
        @endif
        @if(!empty($permission['tag']))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-tag"></use>
                    </svg>
                    Quản lý Tag
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/tag"><span class="c-sidebar-nav-icon"></span> Danh sách</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/tag/update"><span class="c-sidebar-nav-icon"></span> Thêm mới</a></li>
                </ul>
            </li>
        @endif
        @if(!empty($permission['nha_cai']))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/nha_cai/1">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-bank"></use>
                    </svg>
                    Quản lý Nhà cái
                </a>
            </li>
        @endif
        @if(!empty($permission['author']))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-user"></use>
                    </svg>
                    Quản lý Tác giả
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/author"><span class="c-sidebar-nav-icon"></span> Danh sách</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/author/update"><span class="c-sidebar-nav-icon"></span> Thêm mới</a></li>
                </ul>
            </li>
        @endif
        @if(!empty($permission['football_league']))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/football_league">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-football"></use>
                    </svg>
                    Giải bóng đá nổi bật
                </a>
            </li>
        @endif
        {{-- @if(!empty($permission['banner']))
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/admin/banner">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-terrain"></use>
                    </svg>
                    Quản lý Banner
                </a>
            </li>
        @endif --}}
        @if(!empty($permission['user']))
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-user"></use>
                </svg>
                Quản lý Thành viên
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/user"><span class="c-sidebar-nav-icon"></span> Danh sách</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/user/update"><span class="c-sidebar-nav-icon"></span> Thêm mới</a></li>
            </ul>
        </li>
        @endif
        @if(!empty($permission['group']))
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/admin/images/icon-svg/free.svg#cil-lock-locked"></use>
                </svg>
                Quản lý Nhóm quyền
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/group"><span class="c-sidebar-nav-icon"></span> Danh sách</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/group/update"><span class="c-sidebar-nav-icon"></span> Thêm mới</a></li>
            </ul>
        </li>
        @endif
        @if(!empty($permission['site_setting']))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="/admin/images/icon-svg/free.svg#cil-settings"></use>
                    </svg>
                    Cài đặt chung
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/redirect"><span class="c-sidebar-nav-icon"></span> Cấu hình Redirect</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/menu"><span class="c-sidebar-nav-icon"></span> Cấu hình Menu</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/site_setting/update"><span class="c-sidebar-nav-icon"></span> Thông tin trang</a></li>
{{--                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="/admin/site_setting/daga"><span class="c-sidebar-nav-icon"></span> Cấu hình đá gà</a></li>--}}
                </ul>
            </li>
        @endif
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
