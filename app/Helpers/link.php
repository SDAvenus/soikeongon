<?php
function getUrl($slug) {
    return HTTP.DOMAIN.'/'.ltrim($slug, '/');
}
function getUrlPost($item, $is_amp = null, $google_amp = 1){
    $is_amp = $is_amp ?? IS_AMP;
    if(empty($item)) return '';
    $slug = "$item->slug-p$item->id.html";
    if(isset($item->category) && $item->category->id == 25)
    {
        $slug = "$item->slug-dg$item->id.html";
    }
    if ($is_amp)
        $slug .= "/amp";
    $url = getUrl($slug);
    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
    return $url;
}
function getUrlCate($item, $is_amp = null, $google_amp = 1){
    $is_amp = $is_amp ?? IS_AMP;
    if(empty($item))
    {
        return '';
    }
    $slug = "$item->slug-c$item->id";
    if ($is_amp)
        $slug .= "/amp";
    $url = getUrl($slug);
    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
    return $url;
}
function getUrlTag($item, $is_amp = null, $google_amp = 1) {
    $is_amp = $is_amp ?? IS_AMP;
    $slug = "$item->slug-t$item->id";
    if ($is_amp)
        $slug .= "/amp";
    $url = getUrl($slug);
    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
    return $url;
}
function getUrlStaticPage($item, $is_amp = null, $google_amp = 1) {
    $is_amp = $is_amp ?? IS_AMP;
    $slug = "$item->slug-pt$item->id.html";
    if ($is_amp)
        $slug .= "/amp";
    $url = getUrl($slug);
    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
    return $url;
}
function getUrlPostDaGa($item, $is_amp = null, $google_amp = 1)
{
    $is_amp = $is_amp ?? IS_AMP;
    $slug = "$item->slug-dg$item->id.html";
    if ($is_amp)
        $slug .= "/amp";
    $url = getUrl($slug);
    if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
    return $url;
}
function getFullUrl($url, $is_amp = null, $google_amp = 1) {
    $parse = parse_url($url);
    $is_link_out = (isset($parse['host']) && $parse['host'] != env('DOMAIN'));
    if ($is_link_out) {
        return $url;
    } else {
        $is_amp = $is_amp ?? IS_AMP;
        $slug = $parse['path'] ?? '';
        if ($is_amp)
            $slug .= "/amp";
        $url = getUrl($slug);
        if ($google_amp && $is_amp) $url = str_replace('https://', 'https://www.google.com/amp/s/', $url);
        return $url;
    }
}
function getUrlPage($page) {
    $parts = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parts['query'], $query);
    $query['page'] = $page;
    return $parts['path'].'?'.http_build_query($query);
}
function tableOfContent($content) {
    preg_match_all("/<h[23456].*?<\/h[23456]>/",$content,$patt);
    if (empty($patt[0])) return $content;
    $patt2 = $patt[0];
    $index_h2 = 0;
    $index_h3 = 1;
    $danhmuc = "<div class='w-100 border py-2 px-3 mb-3'>
                    <p class='mb-2 d-flex align-items-center summary-title'>
                        <span class=\"mr-2 text-blue2\"></span>
                        <span class='font-weight-bold font-16 text-blue2 w-100 collapsible'>NỘI DUNG CHÍNH</span>
                    </p>";
    $danhmuc .= "<ul class='list-unstyled mb-2'>";

    foreach ($patt2 as $key=>$item){
        $contentItem = strip_tags($item);
        $slug = toSlug($contentItem,'-');
        if (strpos($item, '</h2>') !== false) {
            $index_h2++;
            $danhmuc .= "<li rel='dofollow' class='mb-1'><a class='text-blue2 font-14 font-weight-bold' href='#$slug' >$index_h2. ".$contentItem."</a></li>";
            $index_h3 = 1;
        } else {
            $danhmuc .= "<li rel='dofollow' class='mb-1 pl-3'><a class='text-blue2 font-14 font-weight-bold' href='#$slug' >$index_h2.$index_h3. ".$contentItem."</a></li>";
            $index_h3++;
        }
        $head = substr($item,0,3);
        $tail = substr($item,3);

        $id = " id='$slug'";
        $content = str_replace($item,$head.$id.$tail,$content);
    }
    $danhmuc .= "</ul></div>";
    $content = "$danhmuc<div class='post-content text-justify'>$content</div>";
    return $content;
}
?>
