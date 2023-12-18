<?php

namespace App\Http\Controllers\web;

use App\Models\Matchs;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Log;
use App\Models\LichThiDauIthethao;
use App\Models\Crawler;

require (__DIR__.'/../../../../public/web/libraries/Sunra/PhpSimple/HtmlDomParser.php');

class CrawlerController extends WebController
{
    const URL_BONGDALU = "https://www.bongdalu4.com";
    const URL_BONGDALU_2 = "http://api.sblradar.net/api/v2/soccer/getsoccer/";

    public function index($slug) {
        $this->$slug();
    }

    function get_html($url_crawl, $device = null){
        $crawl = new \Sunra\PhpSimple\HtmlDomParser();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url_crawl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        if ($device == 'mobile')
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3');
        $dom = curl_exec($curl_handle);
        curl_close($curl_handle);
        if(($dom)){
            $dom = $crawl->str_get_html($dom);
            return $dom;
        }
        return '';
    }

    public function crawl_match_info()
    {
        //get post match pending
        $match_pending = Matchs::where('crawl_status', 'pending')->get();

        if(date('H') == '04') (new \App\Models\Matchs)->update_match_done_crawl();

        if($match_pending->count()){
            foreach ($match_pending as $key => $match){
                try{
                    $id_bdl = $match->id_bongdalu;
                    $url_crawl = self::URL_BONGDALU.'/match/live-'.$id_bdl;
                    #
                    $dom = $this->get_html($url_crawl);
                    if(!empty($dom) && $dom->find('div[class=home]')){
                        $time = $dom->find('span[name=timeData] script', 0)->innertext();
                        preg_match('/(.*?)\'(.*?)\'(.*?)/', $time, $time);
                        $time = $time[2];
                        $time = explode(' ', $time);
                        $m_scheduled = date('Y-m-d', strtotime($time[0])).' '.date('H:i:s', strtotime($time[1].$time[2]));
                        $m_scheduled =  date('Y-m-d H:i:s', strtotime($m_scheduled) + 60*60*7);
                        $tournament = $dom->find('.LName',0)->plaintext;
                        if ($dom->find('div[class=home]')) {
                            $logo_home = $dom->find('div[class=home] img', 0)->src;
                        }
                        if ($dom->find('div[class=guest]')) {
                            $logo_away = $dom->find('div[class=guest] img', 0)->src;
                        }
                        if ($dom->find('div[class=home]')) $home_name = $dom->find('div[class=home]',0)->first_child()->text();
                        if ($dom->find('div[class=guest]')) $away_name = $dom->find('div[class=guest]',0)->last_child()->text();
                        $match_info_team = array();
                        if (!empty(trim($tournament))) $match_info_team['tournament'] = trim(html_entity_decode($tournament));
                        if (!empty(trim($home_name))) $match_info_team['team_home_name'] = trim(html_entity_decode($home_name));
                        if (!empty(trim($logo_home)))$match_info_team['team_home_logo'] = $this->saveImageBongdalu(trim($logo_home));
                        if (!empty(trim($away_name))) $match_info_team['team_away_name'] = trim(html_entity_decode($away_name));
                        if (!empty(trim($logo_away)))$match_info_team['team_away_logo'] = $this->saveImageBongdalu(trim($logo_away));
                        if (!empty($m_scheduled)) $match_info_team['scheduled'] = $m_scheduled;

                        $match_info_team = array_filter($match_info_team);
                        if(count($match_info_team) > 1) Matchs::updateOrInsert(['id_bongdalu' => $id_bdl], $match_info_team);
                        #
                        // $bet_data = $this->get_html(self::URL_BONGDALU.'/ajax/soccerajax?type=1&id='.$id_bdl);
                        $bet_data = $this->get_html(self::URL_BONGDALU_2.$id_bdl);
                        if(!empty($bet_data)){
                            $bet_data = $this->convert_bet_data($bet_data);
                            if (empty($bet_data['data'])) continue;
                            $hdc_eu = $bet_data['data'][0].'/'.$bet_data['data'][1].'/'.$bet_data['data'][2];
                            $hdc_asia = $bet_data['data'][7].'*'.$bet_data['data'][8].'*'.$bet_data['data'][9];
                            $hdc_tx = $bet_data['data'][11].'*'.$bet_data['data'][12].'*'.$bet_data['data'][13];
                            #
                            $crawl_status = 'pending';
                            if($hdc_eu!='//' && $hdc_asia!='**' && $hdc_tx!='**'){
                                if(count($match_info_team) == 6)
                                    $crawl_status = 'done';
                            }
                            if ($hdc_eu=='//') {
                                $hdc_eu = "";
                            }
                            if ($hdc_asia=='**') {
                                $hdc_asia = "";
                            }
                            if ($hdc_tx=='**') {
                                $hdc_tx = "";
                            }
                            $match_info = array(
                                'hdc_asia' => trim($hdc_asia),
                                'hdc_eu' => trim($hdc_eu),
                                'hdc_tx' => trim($hdc_tx),
                                'crawl_status' => $crawl_status
                            );
                            Matchs::updateOrInsert(['id_bongdalu' => $id_bdl], $match_info);
                        }
                    }
                }catch(\Exception $e){
                    Log::alert($e->getMessage());
                }
            }
        }
    }

    public function crawl_match_info_live()
    {
        $match_pending = Matchs::where([['scheduled', '>=', Matchs::raw('NOW() - INTERVAL 3 HOUR')], ['scheduled', '<=', Matchs::raw('NOW() + INTERVAL 3 DAY')]])->get();

        if($match_pending->count()){
            foreach ($match_pending as $key => $match){
                try{
                    $id_bdl = $match->id_bongdalu;
                    #
                    // $bet_data = $this->get_html(self::URL_BONGDALU.'/ajax/soccerajax?type=1&id='.$id_bdl);
                    $bet_data = $this->get_html(self::URL_BONGDALU_2.$id_bdl);
                    if(!empty($bet_data)){
                        $bet_data = $this->convert_bet_data($bet_data);
                        if (empty($bet_data['live'])) continue;
                        $hdc_eu = $bet_data['live'][0].'/'.$bet_data['live'][1].'/'.$bet_data['live'][2];
                        $hdc_asia = $bet_data['live'][7].'*'.$bet_data['live'][8].'*'.$bet_data['live'][9];
                        $hdc_tx = $bet_data['live'][11].'*'.$bet_data['live'][12].'*'.$bet_data['live'][13];
                        #
                        if($hdc_eu!='//' && $hdc_asia!='**' && $hdc_tx!='**'){
                            $match_info = array(
                                'hdc_asia' => trim($hdc_asia),
                                'hdc_eu' => trim($hdc_eu),
                                'hdc_tx' => trim($hdc_tx),
                            );
                            Matchs::where(['id_bongdalu' => $id_bdl])->update($match_info);
                        }
                    }
                }catch(\Exception $e){
                }
            }
        }
    }

    protected function saveImageBongdalu($url)
    {
        $url = explode('?', $url);
        $url = $url[0];
        $image_url = $url;
        //$image_url = '/web/images/flags/'.str_replace('//football.bongdalu4.com/image/team/images/', '', $url);
//        $url_path = public_path().$image_url;
//        if(!file_exists($url_path) || !getimagesize($url_path)){
//            try{
//                file_put_contents($url_path, file_get_contents('https:'.$url));
//                if(!getimagesize($url_path)){
//                    $image_url = $url;
//                }
//            } catch(\Exception $e){
//                $image_url = $url;
//                Log::warning($e->getMessage());
//            }
//        }
        return $image_url;
    }

    function convert_bet_data($str_bet_data){
        $bet_data_ar = explode(';',$str_bet_data);
        $bet_data = array();
        for($i=0;$i<count($bet_data_ar);++$i){
            if($bet_data_ar[$i] == 'Crown' || $bet_data_ar[$i] == 'Crow*'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }elseif($bet_data_ar[$i] == 'Bet365'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }elseif($bet_data_ar[$i] == '10BET'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }elseif($bet_data_ar[$i] == 'Interwet*'){
                if($bet_data_ar[$i+1] != ''){
                    $bet_data['data'] = explode(',',$bet_data_ar[$i+1]);
                }
                if($bet_data_ar[$i+2]){
                    $bet_data['live'] = explode(',',$bet_data_ar[$i+2]);
                }
                break;
            }
        }
        $bet_data = $this->parse_betdata( $bet_data );
        return $bet_data;
    }

    function parse_betdata($bet) {
        $run = [11, 13];
        //$run = [7, 9, 11, 13];
        foreach ($run as $i) {
            if (!isset($bet['live'][$i])) continue;

            $data = (float) $bet['live'][$i];

            if ($data > 1) {
                $data = $data - 2;
            }

            $data = number_format($data, 2);
            $bet['live'][$i] = $data;
        }

        foreach ($run as $j) {
            if (!isset($bet['data'][$j])) continue;

            $data = (float) $bet['data'][$j];

            if ($data > 1) {
                $data = $data - 2;
            }

            $data = number_format($data, 2);
            $bet['data'][$j] = $data;
        }

        return $bet;
    }

    public function lich_thi_dau_ithethao(){
        for ($i = 0; $i < 7; $i++) {
            $date = date('d-m-Y', strtotime('+'.$i.' day'));
            $urlPage = 'https://ithethao.vn/football-data/widget-calendar-ajax.html?date='.$date;
            $dom = self::get_html($urlPage);
            if (empty($dom)) dd(1);
            $content = $dom->find('.list-schedule-all', 0)->innertext();
            $content = preg_replace('/<img(.*?)>/', '', $content);
            $content = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
            $content = str_replace('pb-5 pt-0', 'p-3', $content);
            $content = str_replace('style="display: table-caption;"', '', $content);
            $content = str_replace('mr-10', 'mr-2', $content);
            $content = str_replace('mr-5', 'mr-1', $content);
            LichThiDauIthethao::updateOrInsert(['date' => date('Y-m-d', strtotime($date))], ['content' => $content]);
        }
    }
    public function may_tinh_du_doan() {
        $urlPage = 'https://tructiep24h.co/may-tinh-du-doan-bong-da-hom-nay';
        $dom = $this->get_html($urlPage);
        $content = $dom->find('.list-schedule-all', 0)->innertext();
        // $content = preg_replace('/<img(.*?)>/', '', $content);
        $saveData = Crawler::updateOrInsert(['page' => 'may-tinh-du-doan'], ['content' => $content], ['url' => $urlPage]);
        if ($saveData) {
            return response()->json([
                "status" => 200,
                "message" => "Lưu thành công",
            ]);
        }
        return response()->json([
            "status" => 400,
            "message" => "Lưu thất bại",
        ]);
    }

    public function ket_qua_bong_da() {
        $url = 'https://tructiep24h.co/ket-qua-bong-da';
        $dom = $this->get_html($url);
        $date = date('Y-m-d');
        $content = $dom->find('#box-result-'.$date.' .wrap-result-rd', 0)->innertext();
        $content = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
        Crawler::updateOrInsert(['page' => 'ket-qua-bong-da'], ['content' => $content], ['url' => $url]);
    }
}
