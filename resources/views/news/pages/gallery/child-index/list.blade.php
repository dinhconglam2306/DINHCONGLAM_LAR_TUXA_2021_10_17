<div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach($items as $item)
                <div class="col-lg-6">
                    <div class="post_item post_v_med d-flex flex-column align-items-start justify-content-start">
                        <div class="post_image">
                            <a href="{{  asset("images/gallery/" .$item->getFileName())  }}" data-lightbox="roadtrip"> <img src="{{  asset("images/gallery/" . $item->getFileName())  }}" alt="{{ $item->getFileName() }}"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>