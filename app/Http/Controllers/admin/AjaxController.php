<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post_Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Response;
use Hash;
use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Author;

class AjaxController extends Controller
{
    public function changePassword(Request $request) {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $current_password = Auth::user()->password;

        if (Hash::check($old_password, $current_password)) {
            User::find(Auth::user()->id)->update(['password' => bcrypt($new_password)]);
            Auth::user()->update(['password' => bcrypt($new_password)]);
            $response['status'] = 'success';
            $response['message'] = 'Thay đổi mật khẩu thành công!';
        } else {
            $response['status'] = 'fail';
            $response['message'] = 'Mật khẩu cũ không đúng';
        }
        return Response::json($response);
    }

    public function loadTag(Request $request) {
        $post_id = $request->input('post_id');
        $data['tag_selected'] = [];
        if ($post_id > 0) {
            $listTag = Post_tag::where(['post_id' => $post_id])->get();
            foreach ($listTag as $value) {
                $data['tag_selected'][] = $value->tag_id;
            }
        }
        $data['list_tag'] = [];
        $rs = Tag::all();
        foreach ($rs as $value) {
            $data['list_tag'][] = [
                'value' => $value->id,
                'text' => $value->title,
            ];
        }
        return Response::json($data);
    }

    public function loadCategory(Request $request) {
        $post_id = $request->input('post_id');
        $data['category_selected'] = [];
        if ($post_id > 0) {
            $listCategory = Post_Category::where(['post_id' => $post_id])->orderBy('is_primary', 'DESC')->get();
            foreach ($listCategory as $value) {
                $data['category_selected'][] = $value->category_id;
            }
        }
        $data['list_category'] = [];
        $rs = Category::all();
        foreach ($rs as $value) {
            $data['list_category'][] = [
                'value' => $value->id,
                'text' => $value->title,
            ];
        }
        return Response::json($data);
    }

    public function getJsonPosts(Request $request)
    {
        $page = $request->page ?? 1;
        $keyword = $request->q ?? "";
        $posts = Post::where('title', 'like', "%$keyword%")->orderBy('id', 'desc')->paginate(30);
        return response()->json($posts);
    }

    public function loadCategoryAuthor(Request $request)
    {
        $id = $request->author_id ?? null;
        $data = array();
        $categories = Category::get();
        foreach($categories as $category)
        {
            $data['categories'][] = ['value' => $category->id, 'text' => $category->title];
        }
        $data['categories_selected'] = json_decode(Category_author::find($id)->categories ?? null);

        return Response::json($data);
    }

    public function ajax_search_post(Request $request) {
        $keyword = $request->input('keyword');
        $data['data'] = Post::where('slug', 'like', '%' . toSlug($keyword) . '%')->where('status', 1)->orderBy('updated_time', 'DESC')->limit(15)->get();
        $data['status'] = 'success';
        return Response::json($data);
    }

    public function loadAuthor(Request $request) {
        $id = $request->author_id ?? null;
        $data = [];
        $authors = Author::get();
        foreach($authors as $author)
        {
            $data['author'][] = ['value' => $author->id, 'text' => $author->name];
        }
        $data['author_selected'] = json_decode(Author::find($id)->author ?? null);
        return Response::json($data);
    }
}
