@extends('frontend.homepage.layout')

@section('content')
    <div id="homepage" class="homepage">
        
        @if(false && isset($widgets['flash-sale']))
            <div class="panel-flash-sale" id="#flash-sale">
                <div class="uk-container uk-container-center">
                    <div class="main-heading">
                        <div class="panel-head">
                            <h2 class="heading-1"><span>{{ $widgets['flash-sale']->name }}</span></h2>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="uk-grid uk-grid-medium">
                            @foreach ($widgets['flash-sale']->object as $key => $product)
                                <div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-5 mb20">
                                    @include('frontend.component.product-item', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="panel-general page">
            <div class="uk-container uk-container-center">
                @if(isset($widgets['product']->object) && count($widgets['product']->object))
                    @foreach($widgets['product']->object as $key => $category)
                    @php
                        $catName = $category->languages->first()->pivot->name;
                        $catCanonical = write_url($category->languages->first()->pivot->canonical)
                    @endphp
                    <div class="panel-product">
                        <div class="main-heading">
                            <div class="panel-head">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <h2 class="heading-1"><a href="{{ $catCanonical }}" title="{{ $catName }}">{{ $catName }}</a></h2>
                                    <a href="{{ $catCanonical }}" class="readmore">Tất cả sản phẩm</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(count($category->products))
                            <div class="uk-grid uk-grid-medium">
                                @foreach($category->products as $index => $product)
                                <div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-5 mb20">
                                    @include('frontend.component.product-item', ['product' => $product])
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        

    </div>
@endsection
