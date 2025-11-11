@php
    $slideKeyword = App\Enums\SlideEnum::MAIN;
@endphp
@if(count($slides[$slideKeyword]['item']))
<div class="panel-slide page-setup" data-setting="{{ json_encode($slides[$slideKeyword]['setting']) }}">
    <div class="swiper-container">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-wrapper">
            @foreach($slides[$slideKeyword]['item'] as $key => $val )
            <div class="swiper-slide">
                <div class="slide-item">
                    <div class="slide-overlay">
                        <div class="slide-title">{!! $val['name'] !!}</div>
                        <div class="slide-description">{!! $val['description'] !!} </div>
                    </div>
                    
                    <span class="image img-cover">
                        <img class="banner-custom-laptop"  src="{{ $val['image'] }}" alt="{{ $val['name'] }}">
                    </span>

                    <style>
                      
                        .banner-custom-laptop {
                            height: 380px !important;
                            object-fit: cover; 
                            width: 100%;
                        }

    
                    </style>

                
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
@endif