<?php

namespace App\Http\ViewComposers\Web;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = Menu::get();
        $mainMenuPc = $menu->where('id','>=', 1)->find(1);
        $data = [];
        if (!empty($mainMenuPc)) {
            $data['mainMenuPc'] = json_decode($mainMenuPc->data, 1);
        }
        $mainMenuMobile = $menu->find(2);
        if (!empty($mainMenuMobile)) {
            $data['mainMenuMobile'] = json_decode($mainMenuMobile->data, 1);
        }
        $trendingPc = $menu->find(3);
        if (!empty($trendingPc)) {
            $data['trendingPc'] = json_decode($trendingPc->data, 1);
        }
        $trendingMobile = $menu->find(4);
        if (!empty($trendingMobile)) {
            $data['trendingMobile'] = json_decode($trendingMobile->data, 1);
        }
        $categoriesFooter = $menu->find(5);
        if (!empty($categoriesFooter)) {
            $data['categoriesFooter'] = json_decode($categoriesFooter->data, 1);
        }
        $soiKeoFooter = $menu->find(6);
        if (!empty($soiKeoFooter)) {
            $data['soiKeoFooter'] = json_decode($soiKeoFooter->data, 1);
        }
        $endFooter = $menu->find(7);
        if (!empty($endFooter)) {
            $data['endFooter'] = json_decode($endFooter->data, 1);
        }
        $view->with($data);
    }
}
