<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{

    public static function makePayment($cardNumber,$expMonth,$expYear,$cvc,$email,$name,$address,$amount)
    {

    }




    public static function addPayment(Request $request): OrderPayment
    {

        $request->validate([
           'payment_type'=>'required',
        ]);

        $orderPayment = new OrderPayment();
        $orderPayment->payment_type = $request->payment_type;
        if(isset($request->payment_id)){
            $orderPayment->payment_id = $request->payment_id;
        }
        if(isset($request->success)){
            $orderPayment->success = $request->success;
        }
        $orderPayment->save();
        return $orderPayment;
    }
}
