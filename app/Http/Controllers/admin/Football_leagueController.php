<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Request;
use Redirect;
use App\Models\Football_league;

class Football_leagueController extends Controller
{
    public function index() {
        $data['listItem'] = Football_league::orderBy('order_by')->get();
        return view('admin.football_league.index', $data);
    }

    public function update($id = 0) {
        if ($id > 0) {
            $data['oneItem'] = Football_league::findOrFail($id);
        } else {
            $data = [];
        }
        if (!empty(Request::post())) {
            Football_league::updateOrInsert(['id' => $id], Request::post());
            return Redirect::to('/admin/football_league');
        }
        return view('admin.football_league.update', $data);
    }

    public function delete($id) {
        Football_league::destroy($id);
        return back();
    }
}
