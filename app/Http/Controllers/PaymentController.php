<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Price;
use App\Models\Webinar;
use Illuminate\Http\Request;
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
        return $request->all();
    }
}
