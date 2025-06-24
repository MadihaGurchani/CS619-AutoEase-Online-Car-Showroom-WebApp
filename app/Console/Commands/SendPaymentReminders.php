<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class SendPaymentReminders extends Command
{
    protected $signature = 'reminders:send-payment';
    protected $description = 'Send payment reminders for upcoming installments';

    public function handle()
    {
        $orders = Order::where('payment_type', 'installment')
                      ->where('status', '!=', 'completed')
                      ->get();

        foreach ($orders as $order) {
            $installments = $order->installment_details ?? [];
            
            foreach ($installments as $installment) {
                if ($installment['status'] === 'pending') {
                    $dueDate = Carbon::parse($installment['due_date']);
                    $daysUntilDue = now()->diffInDays($dueDate, false);

                    if ($daysUntilDue <= 3 && $daysUntilDue >= 0) {
                        $order->user->notify(new \App\Notifications\InstallmentPaymentReminder($order, $installment));
                    }
                }
            }
        }
    }
}