<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;
use Illuminate\Support\Facades\File;
use App\Models\GalleryModel;
use App\Helpers\Feed;

class GalleryController extends Controller
{
    private $pathViewController = 'news.pages.gallery.';  // slider
    private $controllerName     = 'gallery';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        view()->share('title', 'Thư viện hình ảnh');

        $fileImages = File::allFiles(public_path('/images/gallery'));
        
        return view($this->pathViewController .  'index', [
           'fileImages' => $fileImages,
        ]);
    }
   
}
