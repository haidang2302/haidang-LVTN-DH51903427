<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\SupplyRequest;

class SupplyConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $supplyRequest;

    public function __construct(SupplyRequest $supplyRequest)
    {
        $this->supplyRequest = $supplyRequest;
    }

    public function via($notifiable)
{
    return ['mail', 'database'];
}

public function toDatabase($notifiable)
{
    return [
        'message' => 'Yêu cầu nhập hàng cho sản phẩm #' . $this->supplyRequest->product_id . ' đã được xác nhận.',
        'supply_request_id' => $this->supplyRequest->id,
    ];
}
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Yêu cầu nhập hàng đã được xác nhận')
            ->greeting('Xin chào ' . $notifiable->name)
            ->line('Yêu cầu nhập hàng cho sản phẩm #' . $this->supplyRequest->product_id . ' đã được nhà cung cấp xác nhận.')
            ->action('Xem chi tiết', url('/supply-requests/' . $this->supplyRequest->id))
            ->line('Cảm ơn bạn đã sử dụng hệ thống!');
    }
}
