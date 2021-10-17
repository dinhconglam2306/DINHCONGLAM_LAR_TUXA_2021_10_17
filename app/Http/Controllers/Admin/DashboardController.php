<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use App\Models\RssModel;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $pathViewController = 'admin.pages.dashboard.';  // slider
    private $controllerName     = 'dashboard';
    private $params             = [];
    private $model             = '';

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        

        $totalArticle   = ArticleModel::count();
        $totalCategory  = CategoryModel::count();
        $totalUser      = UserModel::count();
        $totalSlider    = SliderModel::count();
        $totalRss       = RssModel::count();



        $arrMenuValue = [
            ['link' => route('user'),     'name' => 'User', 'icon' => 'fa fa-user', 'total' => $totalUser],
            ['link' => route('category'), 'name' => 'Category', 'icon' => 'fa fa fa-building-o', 'total' => $totalCategory],
            ['link' => route('article'),  'name' => 'Article', 'icon' => 'fa fa-newspaper-o', 'total' => $totalArticle],
            ['link' => route('slider'),   'name' => 'Slider', 'icon' => 'fa fa-sliders', 'total' => $totalSlider],
            ['link' => route('rss'),      'name' => 'Rss', 'icon' => 'fa fa-link', 'total' => $totalRss],
            ['link' => route('menu'),     'name' => 'Menu', 'icon' => 'fa fa-sitemap', 'total' => 1],
            ['link' => route('gallery'),  'name' => 'Gallery', 'icon' => 'fa fa-picture-o', 'total' => 1],
            ['link' => route('setting'),  'name' => 'Cấu hình', 'icon' => 'fa fa-cogs', 'total' => 1],
            ['link' => route('password'), 'name' => 'Password', 'icon' => 'fa fa-key', 'total' =>1],
        ];
        
        return view($this->pathViewController .  'index', [
                'arrMenuValue' => $arrMenuValue,
        ]);
    }
}
