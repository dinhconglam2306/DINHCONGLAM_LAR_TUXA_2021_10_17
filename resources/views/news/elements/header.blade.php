@php 
    use App\Models\CategoryModel ;
    use App\Models\MenuModel;
    use App\Helpers\URL;


    $menuModel     = new MenuModel();
    $itemsMenu     = $menuModel->listItems(null,['task' => 'news-list-items']);




    $xhtmlMenu = '';
    $xhtmlMenuMobile = '';
    $class = '';
    if (count($itemsMenu) > 0) {
        
        $xhtmlMenu = '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        
        foreach ($itemsMenu as $item) {
            $link = $item['link'];
            $target = $item['type_open'];
            
            // $target = config("zvn.template.type_open.$target.type");
            $currentUrl    = request()->path();

            if($link == '/'){
                $class = ($link == $currentUrl)? 'active' : '';
            }else{
                $checkLink     = str_replace('/', '', $link);
                $class = ($currentUrl == $checkLink) ? 'active' : '';
            }

            switch ($item['type_menu']) {

                case 'link':        
                    $xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">';
                    $xhtmlMenu .= sprintf('<li class="%s"><a href="%s" target="%s">%s</a></li>',$class, $link, $target, $item['name']);
                    $xhtmlMenuMobile .=sprintf('<li class="menu_mm"><a href="%s" target="%s">%s</a></li>', $link, $target, $item['name']);
                break;
                case 'category_article':
                    $xhtmlMenu .= sprintf('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">%s<span class="caret"></span></a>', $item['name']);
                    $xhtmlMenuMobile .= sprintf('<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">%s<span class="caret"></span></a>', $item['name']);
                    
                    $categoryModel = new CategoryModel();
                    $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items']);
                    if (count($itemsCategory) > 0) {
                       $xhtmlMenu .='<ul class="dropdown-menu active">';
                       $xhtmlMenuMobile .='<ul class="dropdown-menu">';
                        $classCategory ='';
                        foreach ($itemsCategory as $itemCategory) {
                           $linkCategory = URL::linkCategory($itemCategory['id'],$itemCategory['name']);
                           $activeCategory =  str_replace('http://proj_news_8x.xyz/', '', $linkCategory);

                           $classCategory = (request()->path() == $activeCategory) ? 'active category_article' : '';
                          
                           $xhtmlMenu .= sprintf('<li class="category %s"><a href="%s" target="%s">%s</a></li>',$classCategory, $linkCategory, $target, $itemCategory['name']);
                           $xhtmlMenuMobile .=sprintf('<li class="menu_mm"><a href="%s" target="%s">%s</a></li>', $link, $target, $itemCategory['name']);
                        }
                        $xhtmlMenu .='</ul>';
                        $xhtmlMenuMobile .='</ul>';
                    }

                    $xhtmlMenu .='</li>';
                    $xhtmlMenuMobile .='</li>';
                break;
            }
        }

        if (session('userInfo')) {
            if(session('userInfo')['level'] == 'admin') @$xhtmlMenuUser = sprintf('<li><a href="%s" target="_target">%s</a></li>', route('dashboard'), 'Quản lý web');
            @$xhtmlMenuUser .= sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Logout');
        }else {
            @$xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/login'), 'Login');
        }

        $xhtmlMenu .= $xhtmlMenuUser . '</ul></nav>';
        $xhtmlMenuMobile .= $xhtmlMenuUser . '</ul></nav>';
    }

@endphp

<header class="header">

    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{!! route('home') !!}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image" style="background-image:url({{asset('news/images/zendvn-online.png') }});background-size: contain"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>

                        <!-- Navigation -->
                        {!! $xhtmlMenu !!}

                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
</header>

<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>

    {!! $xhtmlMenuMobile !!}
    
    
</div>