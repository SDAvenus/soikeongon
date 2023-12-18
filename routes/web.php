<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*404*/
Route::any('/404.html', 'PageController@not_found');

Route::get('/{checkAmp}', 'HomeController@index')->where(['checkAmp' => '(amp)?']);
Route::get('/{slug}-p{id}.html{checkAmp}', 'PostController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+', 'checkAmp' => '(/amp)?'])->middleware('Redirect.301');
Route::get('/{slug}-dg{id}.html{checkAmp}', 'Da_gaController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+', 'checkAmp' => '(/amp)?'])->middleware('Redirect.301');
/*Category*/
Route::get('/{slug}-c{id}{checkAmp}', 'CategoryController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+', 'checkAmp' => '(/amp)?'])->middleware('Redirect.301');
Route::get('/{slug}-c{id}/{page}/{date?}{checkAmp}', 'CategoryController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+','page' => '[0-9]+', 'checkAmp' => '(/amp)?'])->middleware('Redirect.301');
Route::get('/{slug}-pt{id}.html{checkAmp}', 'PageController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+', 'checkAmp' => '(/amp)?'])->middleware('Redirect.301');
Route::get('/load-more-posts/{category_id}/{page}', 'CategoryController@loadMorePost');
Route::get('/search/load-more-posts', 'SearchController@loadMorePost');
Route::get('/tag/load-more-posts/{tagid}/{page}', 'TagController@loadMorePosts');
Route::get('/tim-kiem', 'SearchController@index');
Route::get('/{slug}-t{id}', 'TagController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+'])->name('tag_page');
/*Sitemap*/
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap-category.xml', 'SitemapController@category');
Route::get('/sitemap-news.xml', 'SitemapController@news');
Route::get('/sitemap-page.xml', 'SitemapController@page');
Route::get('/sitemap-tag.xml', 'SitemapController@tag');
Route::get('/sitemap-posts-{year}-{month}.xml', 'SitemapController@post')->where(['year'=>'\d+', 'month'=>'\d+']);

Route::get('/ajax_get_ltd/{date}', 'PageController@ajax_get_ltd')->where(['date' => '.*']);
Route::get('/ajax_get_ty_le_keo/{index}', 'PageController@ajax_get_ty_le_keo')->where(['index' => '.*']);
Route::get('/ajax_get_ty_le_keo', 'PageController@ajax_get_ty_le_keo_truc_tuyen');


/*Crawler*/
Route::get('/crawler/{slug}', 'CrawlerController@index')->where(['slug' => '[\s\S]+']);
/*Any*/
// Route::any('{slug}', 'PageController@any')->where('slug', '.*');

Route::get('/tac-gia-{slug}-a{id}.html','PageController@authorPosts')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+', 'checkAmp' => '(/amp)?'])->name('author_post');
