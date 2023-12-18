<?php
function getSchemaBreadCrumb($breadCrumb){
    $itemListElement = [];
    $breadCrumb = array_merge(array([
        'name' => 'Trang chủ',
        'item' => env('APP_URL'),
        'schema' => true,
        'show' => false])
    ,$breadCrumb);
    foreach ($breadCrumb as $key => $item) {
        $itemListElement[] = [
            '@type' => 'ListItem',
            'position' => $key + 1,
            'name' => $item['name'],
            'item' => $item['item']
        ];
    }
    $schema = '<script type="application/ld+json">';
    $schema .= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $itemListElement
    ]);
    $schema .= '</script>';
    return $schema;
}
?>
