<?php

namespace App\Http\Controllers\web;

use App\Models\Category;
use App\Models\Da_ga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Http\Controllers\WebController;

class Da_gaController extends WebController
{
    public function index($slug, $id)
    {
        $data['oneItem'] = Da_ga::find($id);
        if (empty($data['oneItem']) || $data['oneItem']->status == 0 || strtotime($data['oneItem']->displayed_time) > time())
        {
            $user = Auth::user();
            if(empty($user))
                abort(404);
            $group = Group::find($user->group_id);
            $permission = json_decode($group->permission, 1);
            if(empty($permission['post']['index']))
                abort(404);
        }
        $category = Category::find(12);
        if (empty($data['oneItem']))
            abort(404);
        $data['breadCrumb'] = [
            'name' => $data['oneItem']->title,
            'item' => getUrlPostDaGa($data['oneItem']),
            'schema' => true,
            'show' => false
        ];
        if (!empty($category)) {
            $breadCrumb[] = [
                'name' => $category->title,
                'item' => getUrlCate($category),
                'schema' => false,
                'show' => true
            ];
        }
        $breadCrumb[] = [
            'name' => $data['oneItem']->title,
            'item' => getUrlPost($data['oneItem']),
            'schema' => true,
            'show' => false
        ];
        $data['schema'] = getSchemaBreadCrumb($breadCrumb);
        $data['seo_data'] = initSeoData($data['oneItem'] ,'post_daga');
        return view('web.post.da_ga', $data);
    }
}
