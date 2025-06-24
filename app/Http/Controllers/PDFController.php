<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function generateVoucher(Order $order)
    {
        $data = [
            'order' => $order,
            'car' => $order->car,
            'customer' => $order->user,
            'payment_type' => $order->payment_type,
            'delivery_type' => $order->delivery_type,
            'total_amount' => $order->total_amount,
            'delivery_address' => $order->delivery_address,
            'delivery_city' => $order->delivery_city,
            'installment_details' => null
        ];

        if ($order->payment_type === 'installment') {
            $data['installment_details'] = [
                'monthly_amount' => $order->monthly_installment,
                'duration' => $order->installment_months,
                'next_payment_date' => Carbon::parse($order->next_installment_date)
            ];
        }

        $pdf = Pdf::loadView('pdf', $data);
        return $pdf->download('car_purchase_voucher.pdf');
    }
}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}
//{
  //  public function index()
    //{
      //  $pdf = Pdf::loadView('pdf');
        //return $pdf->download('voucher.pdf');
    //}
//}