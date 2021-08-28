<?php

namespace App\Http\Controllers\Api;

use in;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Project;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SubscriptionApiController extends Controller
{
    /**
     * Display a listing of the projects + categories + subcategories, and user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();



        return json_encode([$user]);
    }

    /**
     * Check if the payment is done and for wich subscribtion
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        //$user = Auth()->user();
        $session_id = $request->session;
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if (\Stripe\Checkout\Session::retrieve($session_id)){
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            $customer = \Stripe\Customer::retrieve($session->customer);
            //return response()->json(($session->amount_total == 1000) ? 1000 : false);
            if ($session->payment_status == "paid"){
              if ($session->amount_total == 1000){
                return response()->json(1000);
                //TODO
              } elseif ($session->amount_total == 2000) {
                return response()->json(2000);
                //TODO
              }
            } else {
              return response()->json(["error" => "une erreur est survenue lors du paiement"]);
            }
            return response()->json($session);
        }
        return response()->json(false);

    }
}
