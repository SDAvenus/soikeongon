<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\SiteRedirect;

class RedirectController extends Controller
{
    public function index() {
        $limit = 10;
        $count = SiteRedirect::count();
        $pagination = (int) ceil($count/$limit);
        #
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        #
        $data['listItem'] = SiteRedirect::offset(($page-1)*$limit)->limit($limit)->get();
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        return view('admin.redirect.index', $data);
    }

    public function update($id = 0) {
        $data = [];
        if ($id > 0) $data['oneItem'] = $oneItem = SiteRedirect::findOrFail($id);
        if (!empty(Request::post())) {
            $post_data = Request::post();
            $post_data = $this->parse_data($post_data);
            if (!empty($this->validate_data($post_data))) SiteRedirect::updateOrInsert(['id' => $id], $post_data);
            return Redirect::to('/admin/redirect');
        }
        return view('admin.redirect.update', $data);
    }

    public function delete($id) {
        SiteRedirect::destroy($id);
        return back();
    }

    private function parse_data($data) {
        $first_of_input = substr($data['original_url'], 0, 1);
        $first_of_target = substr($data['redirect_url'], 0, 1);
        if ($first_of_input != '/') $data['original_url'] = '/' . $data['original_url'];
        if ($first_of_target != '/') $data['redirect_url'] = '/' . $data['redirect_url'];
        return $data;
    }

    private function validate_data($data) {
        $result = true;
        if ($data['original_url'] == $data['redirect_url']) $result = false;
        return $result;
    }
}
