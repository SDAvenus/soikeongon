<?php

namespace App\Http\Controllers\web;

use App\Models\Category;
use App\Models\Post;
use App\Models\Football_league;
use App\Models\Nha_Cai;
use App\Models\Author;
use App\Http\Controllers\WebController;
use Carbon\Carbon;
use App\Models\BaiVietNoiBat;
// use phpDocumentor\Reflection\DocBlock\Tags\Author;
class HomeController extends WebController
{
    public function index() {
        $data['top_post_noi_bat'] = BaiVietNoiBat::getBaiVietNoiBat('', 1);
        $arrIdPost = [];
        foreach($data['top_post_noi_bat'] as $key => $val){
            $author_id = $val['post']['author_id'];
            $author = Author::where('id', $author_id)->first();
            $data['top_post_noi_bat'][$key]['post']['name_author'] = $author['name'];
            $data['top_post_noi_bat'][$key]['post']['author_slug'] = $author['slug'];
            $data['top_post_noi_bat'][$key]['displayed_time'] = $val['post']['displayed_time'];
            $arrIdPost[] = $val->post_id;
        }
        // $data['top_post_homepage'] = Post::getPosts([
        //     'category_id' => 1, // Category dự đoán nhận định
        //     'limit' => 4,
        //     'info_category' => 1,
        //     'arrIdPost' => $arrIdPost,
        //     'soikeo_type' => 0,
        // ]);
        $data['top_post_homepage'] = Post::where('status', 1)->where('category_id', 1)->where('soikeo_type', 0)->whereNotIn('id', $arrIdPost)->limit(4)->orderBy('displayed_time', 'desc')->get();
        if ($data['top_post_homepage']) {
            foreach ($data['top_post_homepage'] as $key => $item) {
                $author = Author::where('id', $item->author_id)->first();
                $data['top_post_homepage'][$key]['name_author'] = $author['name'];
                $data['top_post_homepage'][$key]['author_slug'] = $author['slug'];
            }
        }
        $time = date('Y/m/d H:i:s');
        $scheduled_after = date('Y-m-d H:i:s', strtotime($time. ' - 3 hours'));

        $data['football_league'] = Football_league::orderBy('order_by')->get();

        $data['listNhaCai'] = Nha_Cai::where('type', 1)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->get();

        $data['soikeo_today'] = Post::get_list_match(['limit' => -1, 'category_ids' => array(1), 'scheduled_after' => $scheduled_after]);

        $data['seo_data'] = initSeoData();
        $data['keo_goc'] = Post::getPosts([
            'category_id' => 9,
            'limit' => 1
        ]);
        $data['keo_xien'] = Post::getPosts([
            'category_id' => 10,
            'limit' => 1
        ]);
        $data['schema'] = '
<script type="application/ld+json">{
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "soikeongon",
        "email" : "soikeongoncom@gmail.com",
        "url": "https://soikeongon.com/",
        "image": "https://soikeongon.com/upload/admin/2023/06/19/soikeongon.png",
        "sameAs":[
            "https://www.facebook.com/soikeongoncom",
            "https://twitter.com/soikeongoncom",
            "https://www.youtube.com/channel/UCisxdIpn1VEV5z26vYBb1tA",
            "https://www.linkedin.com/in/soikeongon",
            "https://myspace.com/soikeongon",
            "https://www.pinterest.com/soikeongoncom",
            "https://soundcloud.com/soikeongon",
            "https://soikeongoncom.tumblr.com",
            "https://500px.com/p/soikeongon",
            "https://www.reddit.com/user/soikeongoncom"],
        "address":{
            "@type": "PostalAddress",
            "streetAddress": "68 Mậu Lương, Kiến Hưng, Hà Đông, Hà Nội, Việt Nam",
            "addressLocality": "Hà Nội",
            "addressRegion": "HaNoi",
            "postalCode": "152000",
            "addressCountry": "VN"}
    }
</script>';
        return view('web.home.index', $data);
    }
}
