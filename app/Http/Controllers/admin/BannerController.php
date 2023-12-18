<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index() {
        $listItem = Banner::all();
        $data['listItem'] = $listItem;
        return view('admin.banner.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        if ($id > 0) $data['oneItem'] = $oneItem = Banner::findOrFail($id);
        if (!empty(Request::post())) {
            $post_data = Request::post();
            $post_data['slug'] = toSlug($post_data['title']);
            Banner::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/banner');
        }
        return view('admin.banner.update', $data);
    }

    public function delete($id) {
        Banner::destroy($id);
        return back();
    }
}
