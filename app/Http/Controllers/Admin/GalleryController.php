<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Helpers\Template;
use Illuminate\Http\Request;
use App\Models\GalleryModel as MainModel;
use App\Http\Requests\GalleryRequest as MainRequest;

class GalleryController extends Controller
{
    private $pathViewController = 'admin.pages.gallery.';  // slider
    private $controllerName     = 'gallery';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        return view($this->pathViewController .  'index', [
           
        ]);
    }

   
}
