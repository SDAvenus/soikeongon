<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Matchs;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Post_tag;
use App\Models\BaiVietNoiBat;
use App\Http\Controllers\WebController;
use App\Models\Author;
use App\Models\Tag;

class PostController extends WebController
{
    public function index($slug, $id) {
        $oneItem = Post::with('tags')->findOrFail($id);
        if (empty($oneItem) || $oneItem->status == 0 || strtotime($oneItem->displayed_time) > time())
        {
            $user = Auth::user();
            if(empty($user))
                abort(404);
            $group = Group::find($user->group_id);
            $permission = json_decode($group->permission, 1);
            if(empty($permission['post']['index']))
                abort(404);
        }
        if ($oneItem->slug != $slug) return Redirect::to(getUrlPost($oneItem), 301);
        $oneItem->content = parse_content($oneItem->content);
        $name_author = Author::where('id', $oneItem->author_id)->first();
        if ($name_author) {
            $oneItem['name_author'] = $name_author['name'];
            $oneItem['author_slug'] = $name_author['slug'];
        }
        $img = [];
        $pattern = '/<img[^>]*src="([^"]+)"[^>]*>/';
        // $pattern = '/[\'"]([^\'"]+\.(?:jpg|jpeg|png|gif))/';
        preg_match_all($pattern, $oneItem->content, $matches);
        foreach ($matches[1] as $item) {
            $img[] = 'https://soikeongon.com'.$item;
        }
        $data['oneItem'] = $oneItem;
        $img = array_values($img);
        $data['img'] = $img;
        $category = Category::find($oneItem->category_id);
        if ($oneItem->id_bongdalu) {
            $data['match'] = Matchs::where('id_bongdalu', $oneItem->id_bongdalu)->get()->first();
        }
        $data['seo_data'] = initSeoData($oneItem, 'post');

        $data['page'] = $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page == 1) {
            $limit = 7;
            $offset = 0;
        } else {
            $limit = 7;
            $offset = 7 + ($page - 2) * 4;
        }
        $data['post_noi_bat'] = BaiVietNoiBat::getBaiVietNoiBat('', 1);
        $arrPostNoiBat = [];
        if (!empty($data['post_noi_bat'])) {
            foreach ($data['post_noi_bat'] as $item) {
                $post = Post::where('status', 1)->where('id', $item->post_id)->first();
                $arrPostNoiBat[] = $post; 
            }
        }
        $data['arrPostNoiBat'] = $arrPostNoiBat;
        $params = [
            'category_id' => $oneItem->category_id,
            'limit' => $limit,
            'offset' => $offset,
            'soikeo_type' => $oneItem->soikeo_type,
        ];
        // $data['related_post'] = Post::where(['status' => 1, ['displayed_time', '<=', Post::raw('NOW()')], 'category_id' => $oneItem->category_id, 'soikeo_type' => $oneItem->soikeo_type])
        // ->orderBy('displayed_time', 'desc')->offset($offset)->limit($limit)->get();
        $data['related_post'] = Post::getPosts($params);

        $breadCrumb = [];

        if (!empty($category)) {
            $breadCrumb[] = [
                'name' => $category->title,
                'item' => getUrlCate($category),
                'schema' => false,
                'show' => true
            ];
        }
        $breadCrumb[] = [
            'name' => $oneItem->title,
            'item' => getUrlPost($oneItem),
            'schema' => true,
            'show' => false
        ];

        $data['breadcrumb'] = $breadCrumb;
        $data['schema'] = getSchemaBreadCrumb($breadCrumb);
        $data['category_id'] = $oneItem['category_id'];
        $data['author'] = "";
        if (!empty($oneItem->author_id)) {
            $data['author'] = Author::find($oneItem->author_id);
        }
        $tag_id = Post_tag::where('post_id', $id)->select(['tag_id'])->get();
        $tags = [];
        if (!empty($tag_id)) {
            foreach($tag_id as $item) {
                $tags[] = Tag::where('id', $item['tag_id'])->first();
            }
        }
        $data['tags'] = $tags;
        $data['pagePost'] = true;
        return view('web.post.index', $data);
    }
}
