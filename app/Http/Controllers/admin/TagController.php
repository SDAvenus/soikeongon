<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Tag;
use Illuminate\Http\Request as HttpRequest;

class TagController extends Controller
{
    public function index(HttpRequest $request) {
        $keyWord = isset($request->keyword) ? $request->keyword : '' ;
        $data['listItem'] = Tag::where("title", "like", "%$keyWord%")->paginate(10);
        $data['listItem']->appends(['keyword' => $keyWord]);
        return view('admin.tag.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        if ($id > 0) $data['oneItem'] = $oneItem = Tag::findOrFail($id);
        if (!empty(Request::post())) {
            $post_data = Request::post();
            Tag::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/tag');
        }
        return view('admin.tag.update', $data);
    }

    public function delete($id) {
        Tag::destroy($id);
        return back();
    }
}
