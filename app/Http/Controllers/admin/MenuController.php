<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Request;
use Redirect;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index() {
        $limit = 10;
        $count = Menu::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $data['listItem'] = Menu::offset(($page-1)*$limit)->limit($limit)->get();
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.menu.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        $data['categoryTree'] = Category::all();
        if ($id > 0) $data['oneItem'] = $oneItem = Menu::findOrFail($id);
        if (!empty(Request::post())) {
            $post_data = Request::post();
            $post_data = $this->parse_data($post_data);
            if (!empty($this->validate_data($post_data))) Menu::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/menu');
        }
        return view('admin.menu.update', $data);
    }

    public function delete($id) {
        Menu::destroy($id);
        return back();
    }

    private function parse_data($data) {
        unset($data['category_id']);
        unset($data['custom_link']);
        return $data;
    }

    private function validate_data($data) {
        $result = true;

        return $result;
    }
}
