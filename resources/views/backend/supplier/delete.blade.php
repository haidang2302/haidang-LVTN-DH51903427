@extends('backend.dashboard.layout')

@section('content')
@include('backend.dashboard.component.breadcrumb', ['title' => 'Thông tin chung'])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>Thông tin chung</h3>
                </div>
                <div class="ibox-content">
                    <p>Thông tin chung <span class="text-danger">{{ $supplier->name }}</span></p>
                    <p>Bạn đang muốn xóa nhà cung cấp có tên là: <span class="text-danger">{{ $supplier->name }}</span></p>
                    <p>Lưu ý: Không thể khôi phục dữ liệu sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <form action="{{ route('supplier.delete', $supplier->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="name">Tên nhà cung cấp</label>
                            <input type="text" class="form-control" value="{{ $supplier->name }}" disabled>
                        </div>
                        <button type="submit" class="btn btn-danger float-right">Xóa dữ liệu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
