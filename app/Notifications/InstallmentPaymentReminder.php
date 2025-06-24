<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InstallmentPaymentReminder extends Notification
{
    use Queueable;

    protected $order;
    protected $installment;

    public function __construct($order, $installment)
    {
        $this->order = $order;
        $this->installment = $installment;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Payment Reminder - Installment Due')
            ->line('Your installment payment is due soon.')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Amount Due: Rs. ' . number_format($this->installment['amount'], 2))
            ->line('Due Date: ' . $this->installment['due_date'])
            ->action('Make Payment', url('/customer/orders/' . $this->order->id))
            ->line('Thank you for choosing our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'amount' => $this->installment['amount'],
            'due_date' => $this->installment['due_date']
        ];
    }
}