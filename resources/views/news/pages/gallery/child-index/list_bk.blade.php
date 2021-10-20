<div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach($items as $item)
                <div class="col-lg-6">
                    <div class="post_item post_v_med d-flex flex-column align-items-start justify-content-start">
                        <div class="post_image">
                            <img src="{{  asset("images/gallery/$item")  }}" alt="{{ $item }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>