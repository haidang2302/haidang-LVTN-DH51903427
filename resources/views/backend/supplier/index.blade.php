@extends('backend.dashboard.layout')

@section('content')
@include('backend.dashboard.component.breadcrumb', ['title' => 'Danh sách nhà cung cấp'])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Danh sách nhà cung cấp</h5>
                    <a href="{{ route('supplier.create') }}" class="btn btn-danger float-right">+ Thêm mới nhà cung cấp</a>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Sắp xếp</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                                <td><input type="checkbox" value="{{ $supplier->id }}" /></td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td><input type="number" value="{{ $supplier->order ?? 0 }}" class="form-control" style="width:70px;"></td>
                                <td>
                                    <input type="checkbox" {{ ($supplier->status ?? 1) == 1 ? 'checked' : '' }} />
                                </td>
                                <td>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('supplier.delete.confirm', $supplier->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
