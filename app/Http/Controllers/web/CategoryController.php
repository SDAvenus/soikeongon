<?php

namespace App\Http\Controllers\web;

use App\Models\Author;
use App\Models\Category;
use App\Models\Da_ga;
use App\Models\Nha_Cai;
use App\Models\Post;
use Carbon\Carbon;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends WebController
{
    const NHAN_DINH_DU_DOAN_ID = 1;
    public function index($slug, $id, $page = 1, $date = null) {
        if (!is_numeric($page)) $page = 1;
        $oneItem = Category::find($id);
        if (empty($oneItem) || $oneItem->status == 0)
            return Redirect::to(getUrl('404.html'));
        $now = Carbon::now();
        $data = [];
        $data['oneItem'] = $oneItem;
        if ($oneItem->slug != $slug) return Redirect::to(getUrlCate($oneItem), 301);
        $data['seo_data'] = initSeoData($oneItem,'category');

        $limit = 15;

        $params = [
            'category_id' => $id,
            'limit' => $limit,
            'offset' => ($page - 1) * $limit,
        ];

        $view = 'index';
        if ($id == 1) { // Dự đoán nhận định

            $data['post'] = Post::select('match.*', 'post.*');

            $data['post'] = $data['post']->join('match', function($query){
                                            $query->on('post.id_bongdalu', '=', 'match.id_bongdalu');
                                        })
                                        ->join('post_category', function($query){
                                            $query->on('post.id', '=', 'post_category.post_id');
                                        })
                                        ->where('status', 1)
                                        ->where('soikeo_type', 0)
                                        ->where('post_category.category_id', $id)
                                        ->orderBy('scheduled', 'desc')
                                        ->where('scheduled', '>=', date('Y-m-d H:i:s', strtotime('-2 hour')))
                                        ->where('displayed_time', '<', $now)
                                        ->limit($params['limit'])
                                        ->offset($params['offset'])
                                        ->get();
            $view = 'du_doan_nhan_dinh';
            if ($data['post']) {
                foreach ($data['post'] as $key => $item) {
                    $author = Author::where('id', $item->author_id)->first();
                    $data['post'][$key]['name_author'] = $author['name'];
                    $data['post'][$key]['author_slug'] = $author['slug'];
                }
            }
        }else{
            $data['post'] = Post::getPosts($params);
            if ($data['post']) {
                foreach ($data['post'] as $key => $item) {
                    $author = Author::where('id', $item->author_id)->first();
                    $data['post'][$key]['name_author'] = $author['name'];
                    $data['post'][$key]['author_slug'] = $author['slug'];
                }
            }
        }

        $data['page'] = $page;

        if ($oneItem->id == 11) { /*nhà cái*/
            $data['listNhaCai'] = Nha_Cai::where('type', 2)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->get();
            $view = 'nha_cai';
        }

        if ($oneItem->id == 12){ /*đá gà*/
            $data['post'] = Da_ga::where('status', 1)
                                ->where('displayed_time', '<=', date('Y-m-d H:i:s'))
                                ->orderBy('displayed_time', 'desc')
                                ->limit($limit)->get();
            foreach($data['post'] as $post)
            {
                $post->category = $oneItem;
            }
            $view = 'da_ga';
        }
        $breadCrumb = [];
        $breadCrumb[] = [
            'name' => $oneItem->title,
            'item' => getUrlCate($oneItem),
            'schema' => true,
            'show' => true
        ];

        $data['breadCrumb'] = $breadCrumb;

        $data['schema'] = getSchemaBreadCrumb($breadCrumb);

        $data['date'] = $date;
        $data['id'] = $id;
        return view('web.category.'.$view, $data);
    }

    public function loadMorePost($categoryId, $page)
    {
        $limit = 15;

        $params = [
            'category_id' => $categoryId,
            'limit' => $limit,
            'offset' => $page * $limit,
        ];
        if($categoryId == 12){ //đá gà
            $params['limit'] = 10;
            $category = Category::find($categoryId);
            $data['post'] = Da_ga::where('status', 1)
                                ->where('displayed_time', '<=', date('Y-m-d H:i:s'))
                                ->limit($params['limit'])
                                ->offset($params['offset'])
                                ->orderBy('displayed_time', 'desc')
                                ->get();
            foreach($data['post'] as $post)
            {
                $post->category = $category;
            }
        } else{
            if($categoryId == self::NHAN_DINH_DU_DOAN_ID ){
                $data['post'] = Post::whereHas('categories', function($query) use ($categoryId){
                                                $query->where('id', $categoryId);
                                            })
                                            ->with('categories')
                                            ->select('match.*', 'post.*')
                                            ->join('match', 'match.id_bongdalu', '=' , 'post.id_bongdalu')
                                            ->where('status', 1)
                                            ->orderBy('scheduled', 'desc')
                                            // ->where('scheduled', '<', date('Y-m-d H:i:s'))
                                            ->where('displayed_time', '<', date('Y-m-d H:i:s'))
                                            ->where('soikeo_type', 0)
                                            ->limit($params['limit'])
                                            ->offset($params['offset'])
                                            ->orderBy('displayed_time', 'desc')
                                            ->get();
                if ($data['post']) {
                    foreach ($data['post'] as $key => $item) {
                        $author = Author::where('id', $item->author_id)->first();
                        $data['post'][$key]['name_author'] = $author['name'];
                        $data['post'][$key]['author_slug'] = $author['slug'];
                    }
                }
            }else{
                $count = Post::getCount($params);
                $pagination = (int) ceil($count/$limit);
                $data['pagination'] = $pagination;
                $data['page'] = $page;

                $data['post'] = Post::getPosts($params);
                if ($data['post']) {
                    foreach ($data['post'] as $key => $item) {
                        $author = Author::where('id', $item->author_id)->first();
                        $data['post'][$key]['name_author'] = $author['name'];
                        $data['post'][$key]['author_slug'] = $author['slug'];
                    }
                }
            }
        }
        $data['id'] = $categoryId;
        if($data['post']->isEmpty())
        {
            return response()->json(['status' => 204, 'data' => null]);
        }
        $html = view('web.block._load_more_post', $data)->render();

        return response()->json(['status' => 200, 'data' => $html]);
    }
}
