<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use DateTime;
use App\Http\Controllers\WebController;

class SitemapController extends WebController
{
    public function index() {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        //sitemap category
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>'.str_replace("http://", "https://", url('sitemap-category.xml')).'</loc>';
        $sitemap .= '<lastmod>'.date('c',strtotime('-1 hours')).'</lastmod>';
        $sitemap .= '</sitemap>';

        //sitemap page
        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>'.str_replace("http://", "https://", url('sitemap-page.xml')).'</loc>';
        $sitemap .= '<lastmod>'.date('c',strtotime('-1 hours')).'</lastmod>';
        $sitemap .= '</sitemap>';

        $sitemap .= '<sitemap>';
        $sitemap .= '<loc>'.str_replace("http://", "https://", url('sitemap-tag.xml')).'</loc>';
        $sitemap .= '<lastmod>'.date('c',strtotime('-1 hours')).'</lastmod>';
        $sitemap .= '</sitemap>';

        $d1 = new DateTime('2023-06-01');
        $d2 = new DateTime();
        $interval = $d2->diff($d1);
        $interval->format('%m months');

        $month_diff = 12*$interval->y + $interval->m;

        $curent_month = date('Y-m');
        for($i=0;$i<=$month_diff;++$i){
            $sm_date = date('Y-m',strtotime('-'.$i.' month',strtotime($curent_month)));

            //sitemap post
            $sitemap_url = 'sitemap-posts-'.$sm_date.'.xml';
            $sitemap .= '<sitemap>';
            $sitemap .= '<loc>'.str_replace("http://", "https://", url($sitemap_url)).'</loc>';
            $sitemap .= '<lastmod>'.date('c',strtotime('-1 hours')).'</lastmod>';
            $sitemap .= '</sitemap>';
        }

        $sitemap .= '</sitemapindex>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap);exit;
    }

    public function category() {
        $sitemap_category = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap_category .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $categories = Category::all();
        $sitemap_category .= '<url>';
        $sitemap_category .= '<loc>'.url('').'</loc>';
        $sitemap_category .= '<lastmod>'.date('c').'</lastmod>';
        $sitemap_category .= '<changefreq>daily</changefreq>';
        $sitemap_category .= '<priority>1.0</priority>';
        $sitemap_category .= '</url>';

        foreach($categories as $category){
            $sitemap_category .= '<url>';
            $sitemap_category .= '<loc>'.getUrlCate($category).'</loc>';
            $sitemap_category .= '<lastmod>'.date('c').'</lastmod>';
            $sitemap_category .= '<changefreq>daily</changefreq>';
            $sitemap_category .= '<priority>0.8</priority>';
            $sitemap_category .= '</url>';
        }

        $sitemap_category .= '</urlset>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap_category);exit;
    }

    public function Tag(){
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $sitemap .= '<url>';
        $sitemap .= '<loc>'.url('').'</loc>';
        $sitemap .= '<lastmod>'.date('c').'</lastmod>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';
        $tags = Tag::all();
        foreach($tags as $tag)
        {
            $sitemap .= '<url>';
            $sitemap .= '<loc>'.getUrlTag($tag).'</loc>';
            $sitemap .= '<lastmod>'.date('c').'</lastmod>';
            $sitemap .= '<changefreq>daily</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }
        $sitemap .= '</urlset>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap);exit;
    }

    public function news() {
        $sitemap = '<?xml version="1.0"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-news/0.9 http://www.google.com/schemas/sitemap-news/0.9/sitemap-news.xsd">';

        $posts = Post::where(['status'=>1])->get();

        foreach($posts as $post){
            $sitemap .= '<url>';
            $sitemap .= '<loc>'.getUrlPost($post).'</loc>';
            $sitemap .= '<changefreq>always</changefreq>';
            $sitemap .= '<priority>0.9</priority>';
            $sitemap .= '<news:news>';
            $sitemap .= '<news:publication>';
            $sitemap .= '<news:name>'.env('DOMAIN').'</news:name>';
            $sitemap .= '<news:language>vi</news:language>';
            $sitemap .= '</news:publication>';
            $sitemap .= '<news:publication_date>'.date('c',strtotime($post->created_time)).'</news:publication_date>';
            $sitemap .= '<news:title>'.html_entity_decode($post->title).'</news:title>';
            $sitemap .= '<news:keywords>'.html_entity_decode($post->meta_keyword).'</news:keywords>';
            $sitemap .= '</news:news>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap);exit;
    }

    public function page() {
        $sitemap_category = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap_category .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $pages = Page::where(['status'=>1])->get();
        foreach($pages as $page){
            $sitemap_category .= '<url>';
            $sitemap_category .= '<loc>'.getUrlStaticPage($page).'</loc>';
            $sitemap_category .= '<lastmod>'.date('c',strtotime($page->created_time)).'</lastmod>';
            $sitemap_category .= '<changefreq>always</changefreq>';
            $sitemap_category .= '<priority>0.8</priority>';
            $sitemap_category .= '</url>';
        }

        $sitemap_category .= '</urlset>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap_category);exit;
    }

    public function post($year, $month) {
        $sitemap_posts = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap_posts .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $posts = Post::where(['status'=>1])->whereYear('created_time', '=', $year)
            ->whereMonth('created_time', '=', $month)->orderBy('created_time', 'desc')->get();

        foreach($posts as $post){
            $sitemap_posts .= '<url>';
            $sitemap_posts .= '<loc>'.getUrlPost($post).'</loc>';
            $sitemap_posts .= '<lastmod>'.date('c',strtotime($post->created_time)).'</lastmod>';
            $sitemap_posts .= '<changefreq>always</changefreq>';
            $sitemap_posts .= '<priority>0.6</priority>';
            $sitemap_posts .= '</url>';
        }

        $sitemap_posts .= '</urlset>';
        header("Content-Type: text/xml; charset=utf-8");
        print_r($sitemap_posts);exit;
    }
}
