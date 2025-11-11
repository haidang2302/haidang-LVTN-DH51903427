<div class="filter-content filter-minimize">
    <div class="filter-overlay">
        <div class="filter-close">
            <i class="fi fi-rs-cross"></i>
        </div>
        <div class="filter-content-container">
            
            @if(!is_null($filters))
                @foreach($filters as $key => $val)
                @php
                    $catName = $val->languages->first()->pivot->name;
                    if(is_null($val->attributes) || count($val->attributes) == 0) continue;
                @endphp
                <div class="filter-item">
                    <div class="filter-heading">{{ $catName }}</div>
                    @if(count($val->attributes))
                    <div class="filter-body">
                        @foreach($val->attributes as $item)
                        @php
                            $attributeName = $item->languages->first()->pivot->name;
                            $id = $item->id;
                        @endphp
                        <div class="filter-choose">
                            <input 
                                type="checkbox" 
                                id="attribute-{{ $id }}" 
                                class="input-checkbox filtering filterAttribute"
                                value="{{ $id }}"
                                data-group= "{{ $val->id }}"
                            >
                            <label for="attribute-{{ $id }}">{{ $attributeName }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            @endif

            @if(!is_null($filters))
                @foreach($filters as $key => $val)
                @php
                    $catName = $val->languages->first()->pivot->name;
                    if(is_null($val->attributes) || count($val->attributes) == 0) continue;
                @endphp
                <div class="filter-input-value-mobile">
                    <div class="filter-heading">{{ $catName }}</div>
                    @if(count($val->attributes))
                    
                    <div class="filter-body" style="margin-left: 20px">
                        @foreach($val->attributes as $item)
                        @php
                            $attributeName = $item->languages->first()->pivot->name;
                            $id = $item->id;
                        @endphp
                        <div class="filter-choose">
                            <input
                                type="checkbox" 
                                id="attribute-{{ $id }}" 
                                class="input-checkbox filtering filterAttribute"
                                value="{{ $id }}"
                                data-group= "{{ $val->id }}"
                            >
                            <label for="attribute-{{ $id }}">{{ $attributeName }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<input type="hidden" class="product_catalogue_id" value="{{ $productCatalogue->id }}">