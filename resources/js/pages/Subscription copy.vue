

<template>


<!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->
<button
  style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em;cursor:pointer"
  id="checkout-button-price_1JT0OtFCkda43Xw8OTkjwzuL"
  role="link"
  type="button"
>
  Abonnement 25€
</button>


<button
  style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em;cursor:pointer"
  id="checkout-button-price_1JSjCFFCkda43Xw8G6PrlmJW"
  role="link"
  type="button"
>
  Abonnement 10€
</button>

<div id="error-message"></div>

<!---->

    <div class="bg-contain bg-no-repeat bg-right-bottom h-screen" style="background-image: ">
        <div class="flex items-center justify-center">


    <div @submit="formSubmit" class="bg-white  px-8 pt-6 pb-8 mb-4 flex flex-col my-2 sm:w-4/5 md:w-3/5 mx-auto   p-10 mt-20 rounded-lg shadow-lg overflow-hidden">
      <form role="form" action="/abonnement" method="post" class="validation"
      data-cc-on-file="false"
          data-stripe-publishable-key="STRIPE_KEY"
              id="payment-form">
        <div class="-mx-3 md:flex mb-6">
          <div class="required md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
              Nom du titulaire de la carte
            </label>
            <input v-model="payment.name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" type="text" placeholder="Jean Luc Dupond">
            <p class="text-red text-xs italic">Veuillez remplir tous les champs.</p>
          </div>
          <div class="required md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
              Numéro de la carte
            </label>
            <input v-model="payment.cartNumber" class="card-num appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="text" placeholder="4242424242424242">
          </div>
        </div>
        <div class="required -mx-3 md:flex mb-2">
          <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
              CVC
            </label>
            <input v-model="payment.cvc" class="card-cvc appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="text" placeholder="415">
          </div>
          <div class="required md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
              Mois d'expiration
            </label>
            <input v-model="payment.month" class="card-expiry-month appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="text" placeholder="11">
          </div>
          <div class="required md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
              Année d'expiration
            </label>
            <input v-model="payment.year" class="card-expiry-year appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" type="text" placeholder="2027">
          </div>
        </div>
        <div class="inline-flex mt-5">
          <div>
              <button class="px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-800 hover:bg-red-700" type="submit">Payer</button>
          </div>
      </div>
    </form>
  </div>

  </div>
  </div>



</template>


<script>

import axios from 'axios'
import * as stripe from '../services/stripe.js'

export default {

    data(){
        const customer = {
            token : '',
            stripe_token : '',
            amount : '',
            email : '',
            name : '',
            street : '',
            postcode : '',
            city : '',
            country : '',
        }
        const payment = {
            name : '',
            cartNumber : '',
            cvc : '',
            month : '',
            year : '',
        }
        return {
            user: {},
            customer,
            payment,
        }
    },


    methods:{
        loadData(){

            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }

            axios.get("/api/abonnement", config)
            .then(({data}) => (
                this.user = data[0]
            ))
            .catch(error => console.log('error', error))
        },

        loadStripe10(){
            var stripe = Stripe(process.env.STRIPE_KEY);

            var checkoutButton = document.getElementById('checkout-button-price_1JSjCFFCkda43Xw8G6PrlmJW');
            checkoutButton.addEventListener('click', function () {
                /*
                * When the customer clicks on the button, redirect
                * them to Checkout.
                */
                stripe.redirectToCheckout({
                lineItems: [{price: 'price_1JSjCFFCkda43Xw8G6PrlmJW', quantity: 1}],
                mode: 'subscription',
                /*
                * Do not rely on the redirect to the successUrl for fulfilling
                * purchases, customers may not always reach the success_url after
                * a successful payment.
                * Instead use one of the strategies described in
                * https://stripe.com/docs/payments/checkout/fulfill-orders
                */
                successUrl: 'http://localhost:8000/abonnement?session_id={CHECKOUT_SESSION_ID}',
                cancelUrl: 'http://localhost:8000/abonnement',
                })
                .then(function (result) {
                if (result.error) {
                    /*
                    * If `redirectToCheckout` fails due to a browser or network
                    * error, display the localized error message to your customer.
                    */
                    var displayError = document.getElementById('error-message');
                    displayError.textContent = result.error.message;
                }
                });
            })
        },

        loadStripe25(){
            var stripe = Stripe(process.env.STRIPE_KEY);

            var checkoutButton = document.getElementById('checkout-button-price_1JT0OtFCkda43Xw8OTkjwzuL');
            checkoutButton.addEventListener('click', function () {
                /*
                * When the customer clicks on the button, redirect
                * them to Checkout.
                */
                stripe.redirectToCheckout({
                lineItems: [{price: 'price_1JT0OtFCkda43Xw8OTkjwzuL', quantity: 1}],
                mode: 'subscription',
                /*
                * Do not rely on the redirect to the successUrl for fulfilling
                * purchases, customers may not always reach the success_url after
                * a successful payment.
                * Instead use one of the strategies described in
                * https://stripe.com/docs/payments/checkout/fulfill-orders
                */
                successUrl: 'http://localhost:8000/abonnement?session_id={CHECKOUT_SESSION_ID}',
                cancelUrl: 'http://localhost:8000/abonnement',
                })
                .then(function (result) {
                if (result.error) {
                    /*
                    * If `redirectToCheckout` fails due to a browser or network
                    * error, display the localized error message to your customer.
                    */
                    var displayError = document.getElementById('error-message');
                    displayError.textContent = result.error.message;
                }
                });
            });
        },

        formSubmit(e) {
            e.preventDefault();

            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }

            let data = new FormData();
            data.append('name', this.payment.name);
            data.append('cartNumber', this.payment.cartNumber);
            data.append('cvc', this.payment.cvc);
            data.append('month', this.payment.month);
            data.append('year', this.payment.year);

            axios.post('api/abonnement', data, config)
                .then(function (res) {
                    console.log(res);
                })
                .catch(error => { error });

        }
    },
/*
    mounted() {
      let stripeScript = document.createElement('script')
      stripeScript.setAttribute('src', 'https://js.stripe.com/v3/')
      document.head.appendChild(recaptchaScript)
    },
*/
    created(){
        this.loadData();
    },
    mounted(){
        this.loadStripe25();
        this.loadStripe10();
    },
}

</script>


<style>

</style>