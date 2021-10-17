<?php

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
$prefixAdmin = config('zvn.url.prefix_admin');

Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin', 'middleware' => ['permission.admin']], function () {
    // ============================== DASHBOARD ==============================
    $prefix         = '';
    $controllerName = 'dashboard';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
    });

    // ============================== SLIDER ==============================
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-ordering-{ordering}/{id}',   [ 'as' => $controllerName . '/ordering',    'uses' => $controller . 'ordering']);

    });

    //  ============================== MENU ==============================
     $prefix         = 'menu';
     $controllerName = 'menu';
     Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
         $controller = ucfirst($controllerName)  . 'Controller@';
         Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
         Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
         Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
         Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
         Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
         Route::get('change-ordering-{ordering}/{id}',   [ 'as' => $controllerName . '/ordering',    'uses' => $controller . 'ordering']);
         Route::get('change-type-menu-{type_menu}/{id}',   [ 'as' => $controllerName . '/type_menu',    'uses' => $controller . 'typeMenu']);
         Route::get('change-type-open-{type_open}/{id}',   [ 'as' => $controllerName . '/type_open',    'uses' => $controller . 'typeOpen']);
 
     });

     //  ============================== GALLERY ==============================
     $prefix         = 'gallery';
     $controllerName = 'gallery';
     Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
         $controller = ucfirst($controllerName)  . 'Controller@';
         Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
 
     });

    // ============================== CATEGORY ==============================
    $prefix         = 'category';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-is-home-{is_home}/{id}',      [ 'as' => $controllerName . '/isHome',      'uses' => $controller . 'isHome'])->where('id', '[0-9]+');
        Route::get('change-display-{display}/{id}',     [ 'as' => $controllerName . '/display',     'uses' => $controller . 'display']);
        Route::get('change-ordering-{ordering}/{id}',   [ 'as' => $controllerName . '/ordering',    'uses' => $controller . 'ordering']);
    });

    // ============================== ARTICLE ==============================
    $prefix         = 'article';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-type-{type}/{id}',           [ 'as' => $controllerName . '/type',        'uses' => $controller . 'type']);
    });

    // ============================== USER ==============================
    $prefix         = 'user';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::post('change-password',                  [ 'as' => $controllerName . '/change-password',        'uses' => $controller . 'changePassword']);
        Route::post('change-level',                     [ 'as' => $controllerName . '/change-level',        'uses' => $controller . 'changeLevel']);
        Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-level-{level}/{id}',         [ 'as' => $controllerName . '/level',      'uses' => $controller . 'level']);
    });

    // ============================== CONTACT ==============================
    $prefix         = 'contact';
    $controllerName = 'contact';
    Route::group(['prefix' =>  $prefix], function () use($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                        [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status']);
    });

    // ============================== RSS ==============================
    $prefix         = 'rss';
    $controllerName = 'rss';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route::get('form/{id?}',                    [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-ordering-{ordering}/{id}',   [ 'as' => $controllerName . '/ordering',    'uses' => $controller . 'ordering']);
    });

     // ============================== PASSWORD ==============================
    $prefix         = 'password';
    $controllerName = 'password';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                 [ 'as' => $controllerName,      'uses' => $controller . 'index']);
        Route::post('change-password',  [ 'as' => $controllerName . '/change-password',        'uses' => $controller . 'changePassword']);
    });

    // ============================== SETTING ==============================
    $prefix         = 'setting';
    $controllerName = 'setting';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                      [ 'as' => $controllerName,                          'uses' => $controller . 'index']);
        Route::post('/general-setting',       [ 'as' => $controllerName. '/general_setting',      'uses' => $controller . 'general']);
        Route::post('/social-setting',        [ 'as' => $controllerName. '/social_setting',       'uses' => $controller . 'social']);
        Route::post('/email-account-setting', [ 'as' => $controllerName. '/email_account_setting','uses' => $controller . 'emailAccount']);
        Route::post('/email-bcc-setting',     [ 'as' => $controllerName. '/email_bcc_setting',    'uses' => $controller . 'emailBcc']);
    });
});



