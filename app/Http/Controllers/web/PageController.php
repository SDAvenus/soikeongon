<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Page;
use App\Models\Post;
use App\Models\Menu;
use App\Http\Controllers\WebController;
use App\Models\Crawler;
use App\Models\Author;

class PageController extends WebController
{
    public function index($slug, $id) {
        $oneItem = Page::find($id);
        if (empty($oneItem) || $oneItem->status == 0)
            return Redirect::to(url('404.html'));
        if ($oneItem->slug != $slug) return Redirect::to(getUrlStaticPage($oneItem), 301);

        $data['seo_data'] = initSeoData($oneItem, 'page');

        if ($id == 1 || $id == 7) { // Page tỷ lệ kèo
            $data['tylekeohangngay'] =  getTylekeoHangNgay(0);
            $data['tylekeohangngay'] = str_replace("padding-right: 35px;", "", $data['tylekeohangngay']);
            $data['tylekeohangngay'] = str_replace("border: 1px solid;", "", $data['tylekeohangngay']);
            $view = 'ty_le_keo';
        } elseif ($id == 2) { // Máy tính dự đoán
            $view = 'may_tinh_du_doan';
            $may_tinh_du_doan = Crawler::where('page', $slug)->first();
            if (!empty($may_tinh_du_doan['content'])) {
                $data['may_tinh_du_doan'] = $may_tinh_du_doan['content'];
                $data['may_tinh_du_doan'] = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $data['may_tinh_du_doan']);
            } else {
                $data['may_tinh_du_doan'] = "";
            }
        } else {
            $view = 'index';
        }

        $oneItem->content = parse_content($oneItem->content);
        $data['oneItem'] = $oneItem;

        $breadCrumb = [];
        $breadCrumb[] = [
            'name' => $oneItem->title,
            'item' => getUrlStaticPage($oneItem),
            'schema' => true,
            'show' => true
        ];

        $data['breadCrumb'] = $breadCrumb;

        $data['schema'] = getSchemaBreadCrumb($breadCrumb);

        return view('web.page.'.$view, $data);
    }

    public function ajax_get_ltd($date)
    {
        if (!$date) die();
        $lich_thi_dau = getLichThiDau($date);
        echo $lich_thi_dau;
    }

    public function ajax_get_ty_le_keo($index)
    {
        if (!$index) die();
        $tylekeohangngay =  getTylekeoHangNgay($index);
        $tylekeohangngay = str_replace("padding-right: 35px;", "", $tylekeohangngay);
        $tylekeohangngay = str_replace("border: 1px solid;", "", $tylekeohangngay);
        return $tylekeohangngay;
    }


    public function ajax_get_ty_le_keo_truc_tuyen()
    {
        $tylekeo = IS_MOBILE ? getTylekeoMobile() : getTylekeo();
        $tylekeo = str_replace("padding-right: 35px;", "", $tylekeo);
        $tylekeo = str_replace("border: 1px solid;", "", $tylekeo);
        return $tylekeo;
    }

    public function not_found() {
        abort(404);
    }

    public function any() {
        return Redirect::to(url('404.html'));
    }
    public function authorPosts($slug, $id) {
        $author = Author::find($id);
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page == 1) {
            $limit = 4;
            $offset = 0;
        } else {
            $limit = 4;
            $offset = 4 + ($page - 2) * 4;
        }
        $allPost = Post::where('author_id', $id)->where('status', 1)->limit($limit)->offset($offset)->orderBy('displayed_time', 'desc')->get();
        $breadCrumb = [];

        if (!empty($author)) {
            $breadCrumb[] = [
                'id' => $author->id,
                'name' => $author->name,
                'slug' => $author->slug,
                'schema' => false,
                'show' => true
            ];
        }
        $seo_data = initSeoData($author,'author');
        return view('web.page.author_posts',[
            'allPost' => $allPost,
            'author' => $author,
            'breadCrumb' => $breadCrumb,
            'seo_data' => $seo_data,
        ]);
    }
}
