<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedPost;
use Illuminate\Http\Request;

class FeaturedPostController extends Controller
{
    public function index(Request $request)
    {

        if(isset($request->idRemoves))
        {
            FeaturedPost::whereIn('id', $request->idRemoves)->delete();
        }

        if($request->featuredPost)
        {
            foreach($request->featuredPost as $item)
            {
                $id = $item['id'] ?? null;
                FeaturedPost::updateOrInsert(['id' => $id], $item);
            }
            return response()->redirectTo('/admin/post/featured-post');
        }

        $data['featuredPosts'] = FeaturedPost::with('post')->whereHas('post')->orderBy('order')->get();
        return view('admin.post.featured-post', $data);
    }


}
