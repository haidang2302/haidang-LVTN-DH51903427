
@extends('backend.dashboard.layout')
@section('content')
<div class="ibox">
    <div class="ibox-title">
        <h5>Thông báo nhập hàng từ hệ thống</h5>
    </div>
    <div class="ibox-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Thời gian</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                <tr>
                    <td>{{ $notification->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $notification->data['message'] ?? $notification->data['body'] ?? 'Thông báo nhập hàng' }}</td>
                    <td>{{ $notification->read_at ? 'Đã đọc' : 'Chưa đọc' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Không có thông báo nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(method_exists($notifications, 'links'))
    <div class="pagination-wrapper">
        {{ $notifications->links() }}
    </div>
@endif
@endsection