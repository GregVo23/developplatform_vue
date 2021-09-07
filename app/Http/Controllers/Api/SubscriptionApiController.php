<?php

namespace App\Http\Controllers\Api;

use in;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Project;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SubscriptionApiController extends Controller
{
    /**
     * Display a listing of all the subscriptions
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $subscriptions = Subscription::all();
        $subscribtion = DB::table('subscription')->where('user_id', '=', $user->id)->first();

        return json_encode([$user, $subscriptions, $subscribtion]);
    }

    /**
     * Check if the payment is done and for wich subscribtion 10 (5 projects) or 25 for 15 projects, free is for 3 projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $user = Auth()->user();
        $session_id = $request->session;
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if (\Stripe\Checkout\Session::retrieve($session_id)){
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            //$customer = \Stripe\Customer::retrieve($session->customer);
            if ($session->payment_status == "paid"){

              Subscription::firstOrCreate(['user_id' => $user->id]);
              $subscription = Subscription::where('user_id', '=' ,$user->id)->first();
              if ($session->amount_total == 1000){
                $subscription->subscription = '10';
                $subscription->nb_max_projet = '10';
                //return response()->json(1000);
              } elseif ($session->amount_total == 2500) {
                $subscription->subscription = '25';
                $subscription->nb_max_projet = '25';
                //return response()->json(2000);
              }

              if ($subscription->save()){
                  return json_encode([
                      $session->amount_total,
                  ]);
              } else {
                  return response()->json(['errors' => 'Un problème est survenu, veuillez réessayer plus tard.'], 500);
              };

            } else {
              return response()->json(["error" => "une erreur est survenue lors du paiement"]);
            }
            return response()->json($session);
        }
        return response()->json(false);
    }
}
