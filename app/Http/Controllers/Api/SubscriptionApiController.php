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
     * Display a listing of the projects + categories + subcategories, and user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $user = Auth()->user();
        
/*
        $request->validate([
            'stripeToken' => ['required'],
            'amount' => ['required', Rule::in([20, 50])],
            'email' => ['required', 'email'],
            'name' => ['required'],
            'street' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
        ]);

        $request->validate([
            'stripeToken' => ['required'],
            'amount' => ['required', Rule::in([20, 50])],
            'email' => ['required', 'email'],
            'name' => ['required'],
            'street' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
        ]);

        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));

        $intent = \Stripe\PaymentIntent::create([
        'amount' => 1099,
        'currency' => 'eur',
        // Verify your integration in this guide by including this parameter
        'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_KEY'));
          $stripe->subscriptions->create([
            'customer' => 'cus_K6yRCWpdoNUFCl',
            'items' => [
              ['price' => 'price_1JSlMfFCkda43Xw8Md5lJxHE'],
            ],
          ]);
        */
        return response()->json($request->all());
    }
}
