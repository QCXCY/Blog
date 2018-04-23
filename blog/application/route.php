<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//  return [
//     '__pattern__' => [
//          'name' => '\w+',
//      ],
//      // '[hello]'     => [
//      //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//      //     ':name' => ['index/hello', ['method' => 'post']],
//      // ],

//      ''         =>  'index/index',
//      'archives' =>  'archives/index',
//      'article'  =>  'article/index',
//     'about'    =>  'about/index',
//     'search'   =>  'search/index',
//     'sorryxiaoyu'    =>  'sorryxiaoyu/index',

// ];

use think\Route;

Route::rule('','Index/index');
Route::rule('about','About/index');
Route::rule('search','Search/index');
Route::rule('tags/:tags','Tags/index');
Route::rule('article/:artid','Article/index');
Route::rule('archives/:sortid','Archives/index');
Route::rule('sorryxiaoyu','Sorryxiaoyu/index');