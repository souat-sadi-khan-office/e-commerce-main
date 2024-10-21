<?php

namespace App\CPU;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;


class paypal
{
    public static function processPayment($currencyCode, $amount)
    {
        try {
            // Return appropriate PayPal environment
            //  sandbox
            $paypalEnvironment = new SandboxEnvironment(env('PAYPAL_CLIENT_ID_SANDBOX'), env('PAYPAL_SECRET_SANDBOX'));
            //    Live
            // $paypalEnvironment= new ProductionEnvironment(env('PAYPAL_CLIENT_ID_LIVE'), env('PAYPAL_SECRET_LIVE'));


            $client = new PayPalHttpClient($paypalEnvironment);


            // Create Payment
            $createRequest = new OrdersCreateRequest();
            $createRequest->prefer('return=representation');
            $createRequest->body = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => $currencyCode,
                        "value" => $amount
                    ]
                ]],

                // "application_context" => $this->buildApplicationContext($uniqueId, $userID, $subscription->id)
            ];

            // Execute the create payment request
            $createResponse = $client->execute($createRequest);

            // Check if order approval is required
            if ($createResponse->statusCode === 201 && $createResponse->result->status === 'CREATED') {


                // Return the approval URL and unique ID in the response
                return response()->json([
                    'approval_url' => $createResponse->result->links[1]->href,
                ]);
            } else {
                // Return error response if payment creation failed
                return response()->json(['error' => 'Failed to create payment order'], 400);
            }
        } catch (\Exception $ex) {
            // Handle exceptions
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    private function buildApplicationContext($uniqueId, $userID, $subscription)
    {
        // return [
        //     "cancel_url" => route('paypal.cancel'),
        //     "return_url" => route('paypal.return')
        // ];
    }

    // public function returnPayment(Request $request)
    // {
    //     $subscription = Subscription::find($request->input('subscription_id'));
    //     if (!$subscription) {
    //         return response()->json(['error' => 'Wrong Subscription Payment capture failed'], 400);
    //     }
    //     try {

    //         // Retrieve the unique ID from the request
    //         $uniqueId = $request->input('unique_id');

    //         if (!$uniqueId) {
    //             return response()->json(['error' => 'Unique ID not provided'], 400);
    //         }
    //         // Retrieve the corresponding PayPal order from the database using the unique ID
    //         $order = PayPalOrder::where('unique_id', $uniqueId)->first();

    //         if (!$order) {
    //             return response()->json(['error' => 'Order ID not found'], 400);
    //         }

    //         // Capture Payment
    //         $client = new PayPalHttpClient(Helpers::getPayPalEnvironment());
    //         $captureRequest = new OrdersCaptureRequest($order->order_id);
    //         $captureResponse = $client->execute($captureRequest);

    //         // Delete the PayPal order
    //         $order->delete();
    //         // Check if payment was successful
    //         if ($captureResponse->statusCode == 201) {

    //             // dd($request->input('user'), $captureResponse,$captureResponse->result->purchase_units[0]->payments->captures[0]->amount->value);
    //             $data = $captureResponse->result;

    //             $paymentHistory = new PaymentHistory();
    //             $paymentHistory->payment_id = $data->id;
    //             $paymentHistory->user_id = $request->user;
    //             $paymentHistory->status = $data->status;
    //             $paymentHistory->amount = $data->purchase_units[0]->payments->captures[0]->amount->value;
    //             $paymentHistory->email_address = $data->payer->email_address;
    //             $paymentHistory->account_status = $data->payment_source->paypal->account_status;
    //             $paymentHistory->payer_id = $data->payer->payer_id;

    //             if ($data->status === 'COMPLETED') {

    //                 if($subscription->type==='year'){
    //                     $paymentHistory->subscription_end_date =  Carbon::now()->addYear($subscription->duration);
    //                 }elseif($subscription->type==='month'){
    //                     $paymentHistory->subscription_end_date =  Carbon::now()->addMonth($subscription->duration);
    //                 }elseif($subscription->type==='day'){
    //                     $paymentHistory->subscription_end_date =  Carbon::now()->addDays($subscription->duration);

    //                 }else{
    //                     $paymentHistory->subscription_end_date =  Carbon::now()->addDays(30);
    //                 }

    //                 $paymentHistory->save();

    //                 // Update user to premium
    //                 $user = User::find($request->user);
    //                 $user->isPremium = true;
    //                 $user->subscription_id=$subscription->id;
    //                 $user->save();
    //             } else {
    //                 $paymentHistory->save();
    //             }


    //             // Payment successful
    //             return response()->json(['message' => 'Payment successful'], 200);
    //         } else {
    //             return response()->json(['error' => 'Payment capture failed'], 400);
    //         }
    //     } catch (\Exception $ex) {
    //         // Handle exceptions
    //         return response()->json(['error' => $ex->getMessage()], 500);
    //     }
    // }
    public function cancelPayment(Request $request)
    {
        try {
            // You can implement your cancellation logic here
            return response()->json(['message' => 'Payment canceled'], 200);
        } catch (\Exception $ex) {
            // Handle exceptions
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
   
}
