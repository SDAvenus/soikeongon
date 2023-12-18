<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);
        return view('admin.category_author.index', compact('authors'));
    }

    public function update($id = 0, Request $request)
    {
        $author = Author::find($id);
        if(!empty($request->post())){
            $data = $request->post();
            $data['slug'] = toSlug($data['name']);
            $author = Author::updateOrInsert(['id' => $id], $data);
            return redirect('/admin/author');
        }
        return view('admin.category_author.update', compact('author'));
    }

    public function delete($id)
    {
        Author::destroy($id);
        return back();
    }
}
