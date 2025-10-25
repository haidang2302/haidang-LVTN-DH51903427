@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex flex-wrap gap-3">
        @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->id) }}" class="btn btn-category @if(isset($category) && $category->id == $cat->id) active @endif">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    @if(isset($category))
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:40px;width:auto;margin-right:12px;">
                    <h3 class="category-title mb-0">{{ $category->name }}</h3>
                </div>
            </div>
            <div class="row">
                @forelse($category->products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                            <div class="card-body">
                                <div class="product-name fw-bold mb-2">{{ $product->name }}</div>
                                <div class="product-desc mb-2">{{ $product->short_description }}</div>
                                <div class="product-price text-primary fw-bold">{{ number_format($product->price, 0, ',', '.') }}đ</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">Không có sản phẩm nào trong danh mục này.</div>
                @endforelse
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.category-title {
    background: #7c7cf7;
    color: #fff;
    padding: 8px 24px;
    border-radius: 8px;
    font-size: 1.3rem;
    font-weight: 600;
}
.btn-category {
    background: #7c7cf7;
    color: #fff;
    border-radius: 6px;
    padding: 8px 18px;
    font-weight: 500;
    border: none;
}
.btn-category:hover {
    background: #5a5ad6;
    color: #fff;
}
.product-card {
    border: 1px solid #eee;
    border-radius: 12px;
    transition: box-shadow 0.2s;
    box-shadow: 0 1px 4px rgba(124,124,247,0.06);
}
.product-card:hover {
    box-shadow: 0 2px 16px rgba(124,124,247,0.15);
}
.product-img {
    object-fit: cover;
    height: 220px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.product-name {
    font-size: 1.1rem;
}
.product-desc {
    color: #444;
    font-size: 0.97rem;
}
.product-price {
    font-size: 1.1rem;
}
</style>
@endpush
