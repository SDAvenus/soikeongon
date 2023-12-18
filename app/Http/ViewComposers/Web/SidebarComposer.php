<?php

namespace App\Http\ViewComposers\Web;

use App\Models\Category;
use App\Models\Football_league;
use App\Models\Nha_Cai;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\Crawler;

class SidebarComposer
{
    public function compose(View $view)
    {
        $data['listNhaCai'] = Nha_Cai::where('type', 1)->orderBy(Nha_Cai::raw('order_by = 0'))->orderBy('order_by')->where('order_by', '<>', 0)->get();
        $data['kinh_nghiem_soi_keo'] = Post::getPosts([
            'category_id' => 1, // Category dự đoán nhận định
            'limit' => 5
        ]);
        $ket_qua_thi_dau_siderbar = Crawler::where('id',31)->select(['content'])->first()->content ?? '';
        $ket_qua_thi_dau_siderbar = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $ket_qua_thi_dau_siderbar);
        $ket_qua_thi_dau_siderbar = preg_replace('#onclick=\"(.*?)\"#i', '', $ket_qua_thi_dau_siderbar);
        $data['ket_qua_thi_dau_siderbar'] = $ket_qua_thi_dau_siderbar;
        $data['nha_cai_i9'] = Nha_Cai::where(['type' => 1, 'order_by' => 0])->first();
        $view->with($data);
    }
}
