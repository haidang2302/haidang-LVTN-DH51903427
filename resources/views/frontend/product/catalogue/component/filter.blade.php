<div class="filter">
    <div class="uk-flex uk-flex-middle">
        <div class="filter-widget mr20">
            <div class="uk-flex uk-flex-middle">
                 
                
                <div class="filter-button ml10 mr20">
                    <a href="" class="btn-filter uk-flex uk-flex-middle">
                        <i class="fi-rs-filter mr5"></i>
                        <span>Bộ Lọc</span>
                    </a>
                </div>
               
            </div>
        </div>
        <div class="perpage uk-flex uk-flex-middle">
            <div class="filter-text">Hiển thị</div>
            <select name="perpage" id="perpage" class="nice-select">
                @for($i = 20; $i <= 100; $i+=20)
                <option value="{{ $i }}"> {{ $i }} sản phẩm </option>
                @endfor
            </select>
        </div>
        
    </div>
</div>