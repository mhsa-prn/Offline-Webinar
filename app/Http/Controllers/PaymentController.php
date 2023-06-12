<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Price;
use App\Models\Webinar;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $webinar = Webinar::find($request->webinar);
        if(!$webinar) return back()->with(['error'=>'وبینار مورد نظر وجود ندارد.']);

        $amount = Price::first()->amount;

        return ShetabitPayment::purchase(
            (new Invoice)->amount($amount),
            function($driver, $transactionId) use ($request, $webinar, $amount) {
                $request->user()->payments()->create([
                    'webinar_id' => $webinar->id,
                    'amount' => $amount,
                    'ref_num' => $transactionId
                ]);
            }
        )->pay()->render();
    }

    public function verify(Request $request)
    {
        $transaction_id=$request->Authority;
        $payment = Payment::where('ref_num',$transaction_id)->first();
        if(!$payment) throw new \Exception('وبینار پیدا نشد');
        try {
            $receipt = ShetabitPayment::amount($payment->amount)->transactionId($transaction_id)->verify();

            $payment->update([
                'res_num' => $receipt->getReferenceId(),
                'status' => true
            ]);
            $webinar = Webinar::find($payment->webinar_id);
            $webinar->update([
               'confirmed' => true
            ]);
            return redirect(route('webinars.index'))->with(['success'=>'پرداخت شما با موفقیت انجام شد.']);

        } catch (InvalidPaymentException $exception) {
            return redirect(route('webinars.index'))->with(['error'=>$exception->getMessage()]);
        }
    }
}
