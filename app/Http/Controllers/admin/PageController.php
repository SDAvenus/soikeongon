<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Request;
use Redirect;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index() {
        $limit = 10;
        $count = Page::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $condition = [];
        if (isset($_GET['status'])) {
            $condition[] = ['status', $_GET['status']];
        }
        if (!empty($_GET['keyword'])) {
            $condition[] = ['slug', 'LIKE', '%'.toSlug($_GET['keyword']).'%'];
        }
        if (!empty($_GET['user_id'])) {
            $condition[] = ['user_id', $_GET['user_id']];
        }
        #
        $data['listUser'] = User::where('status', 1)->get();
        #
        $data['listItem'] = Page::where($condition)->offset(($page-1)*$limit)->limit($limit)->get();
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.page.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        $data['user_id'] = Auth::id();

        if ($id > 0) {
            $data['oneItem'] = $oneItem = Page::findOrFail($id);
            $data['optional'] = json_decode($oneItem->optional);
        }
        if (!empty(Request::post())) {
            $post_data = Request::post();
            if (empty($post_data['slug'])) $post_data['slug'] = toSlug($post_data['title']);
            Page::updateOrInsert(['id' => $id], $post_data);

            return Redirect::to('/admin/page?status=1');
        }
        return view('admin.page.update', $data);
    }

    public function delete($id) {
        Page::destroy($id);
        return back();
    }
}
