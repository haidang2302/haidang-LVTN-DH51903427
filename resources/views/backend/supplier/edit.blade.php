@extends('backend.dashboard.layout')

@section('content')
@include('backend.dashboard.component.breadcrumb', ['title' => 'Sửa nhà cung cấp'])
@php
    $url = route('supplier.update', $supplier->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    @method('PUT')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin nhà cung cấp</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="name">Tên nhà cung cấp</label>
                            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="{{ $supplier->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" value="{{ $supplier->address }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật nhà cung cấp</button>
    </div>
</form>
@endsection
