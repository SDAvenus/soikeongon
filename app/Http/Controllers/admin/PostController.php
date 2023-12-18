<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternalLink;
use App\Models\Matchs;
use App\Models\User;
use Request;
use Redirect;
use App\Models\Post;
use App\Models\Category;
use App\Models\ComputerPredict;
use App\Models\Post_tag;
use App\Models\Post_Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
use App\Models\Log;
class PostController extends Controller
{
    public function index() {
        $data['group_id'] = $group_id = Auth::user()->group_id;
        $limit = 10;
        $count = Post::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $condition = [];
        if (isset($_GET['status'])) {
            $condition[] = ['status', $_GET['status']];
        }
        if (!empty($_GET['hen_gio'])) {
            $condition[] = ['displayed_time', '>', Post::raw('NOW()')];
        } elseif (!empty($_GET['status'])) {
            $condition[] = ['displayed_time', '<=', Post::raw('NOW()')];
        }
        if (!empty($_GET['keyword'])) {
            $condition[] = ['slug', 'LIKE', '%'.toSlug($_GET['keyword']).'%'];
        }
        if (!empty($_GET['category_id'])) {
            $condition[] = ['category_id', $_GET['category_id']];
        }
        if (!empty($_GET['user_id'])) {
            $condition[] = ['user_id', $_GET['user_id']];
        }
        if ($group_id != 1) {
            $condition[] = ['user_id', Auth::id()];
        }
        if (!empty($_GET['is_soikeo'])) {
            $condition[] = ['is_soikeo', 1];
        } else {
            $condition[] = ['is_soikeo', 0];
        }
        #
        $data['categoryTree'] = Category::getTree();
        $data['listUser'] = User::where('status', 1)->get();
        #
        $listItem = Post::with('categories')->with('tags')->where($condition)->orderBy('displayed_time', 'DESC')->offset(($page-1)*$limit)->limit($limit)->get();

        $data['total'] = Post::where($condition)->count();
        foreach ($listItem as $key => $item) {
            $listItem[$key]->count_link_ve = InternalLink::where('post_id_out', $item->id)->count();
        }

        $data['listItem'] = $listItem;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.post.index', $data);
    }

    public function update($id = 0) {
        $data['categoryTree'] = Category::getTree();
        $data['user_id'] = Auth::id();
        $data['group_id'] = Auth::user()->group_id;
        $data['author'] = Author::get();

        if ($id > 0) {
            $data['oneItem'] = $oneItem = Post::findOrFail($id);
            $data['user'] = User::find($oneItem->user_id);
            if (!empty($oneItem->id_bongdalu) || !empty($oneItem->id_match))
                if($oneItem->id_bongdalu){
                    $data['match'] = Matchs::where('id_bongdalu', $oneItem->id_bongdalu)->first();
                }
                elseif($oneItem->id_match){
                    $data['match'] = Matchs::where('id', $oneItem->id_match)->first();
                }

                if(isset($data['match']->id))
                {
                    $data['computerPredict'] = ComputerPredict::where('match_id', $data['match']->id)->first();
                }
        }
        if (!empty(Request::post()['title'])) {
            $post_data = Request::post();
            if (empty($post_data['slug'])) $post_data['slug'] = toSlug($post_data['title']);
            if (!empty($post_data['tag'])) {
                $post_tag = $post_data['tag'];
                unset($post_data['tag']);
            }

            if (!empty($post_data['category'])) {
                $post_category = $post_data['category'];
                unset($post_data['category']);
                $post_data['category_id'] = $post_category[0];
            }

            if (!empty($post_data['id_bongdalu']) || !empty($post_data['match']['scheduled'])){
                $post_data['match']['id_bongdalu'] = $post_data['id_bongdalu'];
                if($post_data['id_bongdalu'])
                {
                    $match = Matchs::where('id_bongdalu', $post_data['id_bongdalu'])->first();
                }elseif($post_data['id_match'])
                {
                    $match = Matchs::where('id', $post_data['id_match'])->first();
                }

                if(isset($match) && $match->crawl_status == 'pending')
                {
                    $match->update($post_data['match']);
                }

                if(!isset($match))
                {
                   $match = new Matchs;
                   $match->fill($post_data['match']);
                   $match->save();
                }

                if(!empty($post_data['computerPredict']) && isset($match->id))
                {
                    ComputerPredict::updateOrInsert(['match_id' => $match->id], $post_data['computerPredict']);
                }
                $post_data['id_match'] = $match->id;
            }
            unset($post_data['match']);
            unset($post_data['computerPredict']);

            if ($id > 0) {
                Post::where('id', $id)->update($post_data);
                $action = 'update';
            } else {
                $id = Post::insertGetId($post_data);
                $action = 'add';
            }

            Log::insert([
                'user_id' => $data['user_id'],
                'post_id' => $id,
                'content' => json_encode($post_data),
                'action' => $action
            ]);

            if (!empty($post_tag)) {
                if ($id > 0)
                    Post_tag::where('post_id', $id)->delete();
                foreach ($post_tag as $item) {
                    Post_tag::insert(['post_id' => $id, 'tag_id' => $item]);
                }
            } else {
                if ($id > 0) {
                    Post_tag::where('post_id', $id)->delete();
                }
            }

            if (!empty($post_category)) {
                if ($id > 0)
                    Post_Category::where('post_id', $id)->delete();
                foreach ($post_category as $key => $item) {
                    if ($key == 0)
                        Post_Category::insert(['post_id' => $id, 'category_id' => $item, 'is_primary' => 1]);
                    else
                        Post_Category::insert(['post_id' => $id, 'category_id' => $item]);
                }
            }

            InternalLink::updateData($id, $post_data['description'].$post_data['content']);

            return Redirect::to('/admin/post?status=1&is_soikeo='.$post_data['is_soikeo']);
        }
        return view('admin.post.update', $data);
    }

    public function delete($id) {
        $post = Post::find($id);
        Post_tag::where('post_id', $id)->delete();
        Post_Category::where('post_id', $id)->delete();
        if(isset($post->id_bongdalu))
        {
            $match = Matchs::where('id_bongdalu', $post->id_bongdalu)->first();
        }
        if(isset($post->id_match))
        {
            $match = Matchs::where('id', $post->id_match)->first();
        }

        if(isset($match->id))
        {
            ComputerPredict::where('match_id', $match->id)->delete();
            $match->delete();
        }
        $post->delete();
        Log::insert([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'content' => json_encode($post->toArray()),
            'action' => 'delete'
        ]);
        return back();
    }

    public function listTitleToStr($listItem)
    {
        $str = "";
        foreach ($listItem as $item)
        {
            $str .= "$item->title - ";
        }
        $str = trim($str, '- ');
        return $str;
    }
}
