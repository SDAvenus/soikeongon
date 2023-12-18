<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data['keyword'] = $keyword = $request->q;
        $now = now();
        $limit = 10;
        $data['page'] = $page = $request->page ?? 0;
        $data['posts'] = Post::where("title", "like", "%$keyword%")
                        ->with('category')
                        ->where('status', 1)
                        ->where('displayed_time', '<=', $now)
                        ->limit($limit)
                        ->offset($page)
                        ->get();
        $breadCrumb = [];
        $breadCrumb[] = [
            'name' => 'Tìm kiếm',
            'item' => url("/tim-kiem"),
            'schema' => true,
            'show' => true
        ];
        
        $data['breadCrumb'] = $breadCrumb;

        // $data['schema'] = getSchemaBreadCrumb($breadCrumb);
        return view('web.search.index', $data);
    }

    public function loadMorePost(Request $request)
    {   
        $page = $request->page;
        $keyword = $request->keyword;
        $page +=1;
        $now = now();
        $data['post'] = Post::where("title", "like", "%$keyword%")
        ->with('category')
        ->where('status', 1)
        ->where('displayed_time', '<=', $now)
        ->limit(10)
        ->offset($page*10)
        ->get();
        
        if($data['post']->isEmpty())
        {
            return response()->json(['status' => 204, 'data' => null]);
        }
        $html = view('web.block._load_more_post', $data)->render();

        return response()->json(['status' => 200, 'data' => $html]);
    }
}
