@foreach ($items as $item)
<div class="col-sm-4 col-lg-4">
    <div class="feature-box fbox-center fbox-bg fbox-plain text-center">
        <div class="fbox-icon">
            <a href="#"><i class="{{ $item['icon'] }} icon-size" aria-hidden="true"></i></a>
        </div>
        <div class="fbox-content subtitle">
            <h4>{{ $item['name'] }}</h4>
            <span>{{ $item['description'] }}</span>
        </div>
    </div>
</div>
@endforeach