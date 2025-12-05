<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedForSeller extends Notification
{
    use Queueable;

    public $order;
    public $items; // items that belong to this seller
    public $buyer;

    public function __construct($order, $items, $buyer)
    {
        $this->order = $order;
        $this->items = $items;
        $this->buyer = $buyer;
    }

    public function via($notifiable)
    {
        // kirim ke mail & database (in-app)
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('/seller/orders/'.$this->order->id);

        $mail = (new MailMessage)
            ->subject("Pesanan baru #{$this->order->id} dari {$this->buyer->name}")
            ->greeting('Halo,')
            ->line("Anda mendapatkan pesanan baru (Order #{$this->order->id}).")
            ->line("Pembeli: {$this->buyer->name}")
            ->line("Jumlah item untuk toko Anda: ".count($this->items));

        foreach ($this->items as $it) {
            $mail->line(" - {$it->product_name} x{$it->qty}");
        }

        $mail->action('Lihat Pesanan', $url)
             ->line('Segera proses pesanan untuk menjaga kepuasan pelanggan.');

        return $mail;
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'buyer_id' => $this->buyer->id,
            'buyer_name' => $this->buyer->name,
            'items_count' => count($this->items),
            'items' => array_map(function($it){
                return [
                    'product_id' => $it->product_id,
                    'product_name' => $it->product_name,
                    'qty' => $it->qty,
                ];
            }, $this->items),
            'url' => url('/seller/orders/'.$this->order->id),
            'message' => "Pesanan #{$this->order->id} baru untuk toko Anda."
        ];
    }
}
