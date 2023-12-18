<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\SiteSetting;

class Site_SettingController extends Controller
{
    public function update() {
        $data = [];
        $data['oneItem'] = [];
        foreach (SiteSetting::all() as $value) {
            $data['oneItem'][$value->setting_key] = $value->setting_value;
        }
        $data['oneItem'] = (object) $data['oneItem'];
        if (!empty(Request::post())) {
            $post_data = Request::post();
            foreach ($post_data as $key => $value) {
                SiteSetting::updateOrInsert(['setting_key' => $key], ['setting_value' => $value]);
            }
            return Redirect::to('/admin/site_setting/update');
        }
        return view('admin.site_setting.update', $data);
    }

    public function updateSettingDaGa()
    {
        $daGaSetting = SiteSetting::where('setting_key', 'site_daga')->first();
        if(isset(Request::post()['site_daGa']))
        {
            SiteSetting::updateOrInsert(['setting_key'=> 'site_daGa'], ['setting_value' => Request::post()['site_daGa']]);
            return Redirect::to('/admin/site_setting/daga');
        }
        return view('admin.site_setting.setting_da_ga', compact('daGaSetting'));
    }
}
