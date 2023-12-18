<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Da_ga;
use Illuminate\Support\Facades\Auth;

class Da_gaController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;
        $status = 1;
        if(isset($request->status) && $request->status == 0) $status = 0;
        $data['listItem'] = Da_ga::where('status', $status)->orderBy('displayed_time', 'desc')->paginate($limit);
        $data['listItem']->appends(['status' => $status]);
        return view('admin.da_ga.index', $data);
    }

    public function update($id = 0, Request $request)
    {
        $data = [];
        $data['group_id'] = Auth::user()->group_id;
        if($id > 0) {
            $data['oneItem'] = Da_ga::findOrFail($id);
        }
        if(!empty($request->post())){
            $data = $request->post();
            Da_ga::updateOrInsert(['id' => $id], $data);
            return redirect('/admin/post/da-ga');
        }
        return view('admin.da_ga.update', $data);
    }

    public function delete($id)
    {
        Da_ga::destroy($id);
        return back();
    }

}
