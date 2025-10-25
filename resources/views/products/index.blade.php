@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Danh sách Product</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->short_description }}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                <td>{{ $product->category->name ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
