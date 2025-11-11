@php

    $name = $product->languages->first()->pivot->name;
    $canonical = write_url($product->languages->first()->pivot->canonical);
    $image = image($product->image);
    $price = getPrice($product);
    $catName = $product->product_catalogues->first()->languages->first()->pivot->name;
    $review = getReview($product);
@endphp
<div class="product-item product">
    
    <a href="{{ $canonical }}" class="image img-scaledown img-zoomin"><img src="{{ $image }}" alt="{{ $name }}"></a>
    <div class="info">
        
        <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
        
        <div class="product-group">
            {!! $price['html'] !!}
        </div>
    </div>
</div>