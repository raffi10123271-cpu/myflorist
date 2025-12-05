<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedForBuyer extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('/orders/'.$this->order->id);

        return (new MailMessage)
            ->subject("Pesanan Anda #{$this->order->id} berhasil dibuat")
            ->greeting("Halo {$notifiable->name},")
            ->line("Terima kasih, pesanan Anda (#{$this->order->id}) telah berhasil dibuat.")
            ->line("Total: Rp " . number_format($this->order->total,0,',','.'))
            ->action('Lihat Pesanan', $url)
            ->line('Silakan lakukan pembayaran jika belum, dan tunggu konfirmasi dari penjual.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'total' => $this->order->total,
            'url' => url('/orders/'.$this->order->id),
            'message' => "Pesanan #{$this->order->id} berhasil dibuat."
        ];
    }
}
