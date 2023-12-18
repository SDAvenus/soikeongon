<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\BaiVietNoiBat;
class BaiVietNoiBatController extends Controller
{
    public function __construct()
    {

    }
    public function BaiVietNoiBat(){
        $data['listItem'] = BaiVietNoiBat::with('post')->where('type', 1)->orderBy('order_by', 'ASC')->get();

        if (!empty(Request::post())) {
            BaiVietNoiBat::where('type', 1)->delete();
            $topgame_id = Request::post()['post_id'] ?? [];
            foreach($topgame_id as $k => $tid){
                BaiVietNoiBat::updateOrInsert(['post_id' => $tid], ['type' => 1, 'order_by' => $k + 1]);
            }
            return Redirect::back();
        }
        return view('admin.bai_viet_noi_bat.index', $data);
    }
    public function delete($id) {
        TopGameHome::destroy($id);
        return back();
    }
}
