<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="bg-gray-200">
    <div class="pt-12 sm:pt-16 lg:pt-24">
      <div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto space-y-2 lg:max-w-none">
          <h2 class="text-lg leading-6 font-semibold text-gray-700 uppercase tracking-wider">
            Nos formules
          </h2>
          <p class="text-3xl font-extrabold text-gray-900 sm:text-4xl lg:text-5xl">
            Découvrez nos formules d'abonnement !
          </p>
          <p class="text-xl text-gray-700">
            Vous souhaitez demander et exécuter plus qu'un projet par mois ? Faites votre choix !
          </p>
        </div>
      </div>
    </div>
    <div class="mt-8 pb-12 bg-gray-200 sm:mt-12 sm:pb-16 lg:mt-16 lg:pb-24">
      <div class="relative">
        <div class="absolute inset-0 h-3/4 bg-gray-200" />
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="max-w-md mx-auto space-y-4 lg:max-w-5xl lg:grid lg:grid-cols-2 lg:gap-5 lg:space-y-0">



            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
              <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                <div>
                  <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600" id="tier-standard">
                    Developplatform 10
                  </h3>
                </div>
                <div class="mt-4 flex items-baseline text-6xl font-extrabold">
                  10€
                  <span class="ml-1 text-2xl font-medium text-gray-500">
                    /année
                  </span>
                </div>
                <p class="mt-5 text-lg text-gray-500">
                  description
                </p>
              </div>
              <div class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                <ul role="list" class="space-y-4">
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <CheckIcon class="h-6 w-6 text-yellow" aria-hidden="true" />
                    </div>
                    <p class="ml-3 text-base text-gray-700">
                      3 demandes de réalisation/mois
                    </p>
                  </li>
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <CheckIcon class="h-6 w-6 text-yellow" aria-hidden="true" />
                    </div>
                    <p class="ml-3 text-base text-gray-700">
                      3 création de projet/mois
                    </p>
                  </li>
                </ul>
                <div>

                  <button
                    class="inline-flex items-center px-5 pt-4 pb-3.5 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-200 transform hover:-translate-y-1 hover:translate-x-0.5"
                    id="checkout-button-price_1JSjCFFCkda43Xw8G6PrlmJW"
                    role="link"
                    type="button"
                  >
                    Abonnement 10€
                  </button>

                  <div id="error-message"></div>

                </div>
              </div>
            </div>




            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
              <div class="px-6 py-8 bg-white sm:p-10 sm:pb-6">
                <div>
                  <h3 class="inline-flex px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-indigo-100 text-indigo-600" id="tier-standard">
                    Developplatform 25
                  </h3>
                </div>
                <div class="mt-4 flex items-baseline text-6xl font-extrabold">
                  25€
                  <span class="ml-1 text-2xl font-medium text-gray-500">
                    /année
                  </span>
                </div>
                <p class="mt-5 text-lg text-gray-500">
                  description
                </p>
              </div>
              <div class="flex-1 flex flex-col justify-between px-6 pt-6 pb-8 bg-gray-50 space-y-6 sm:p-10 sm:pt-6">
                <ul role="list" class="space-y-4">
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <CheckIcon class="h-6 w-6 text-yellow" aria-hidden="true" />
                    </div>
                    <p class="ml-3 text-base text-gray-700">
                      10 demandes de réalisation/mois
                    </p>
                  </li>
                  <li class="flex items-start">
                    <div class="flex-shrink-0">
                      <CheckIcon class="h-6 w-6 text-yellow" aria-hidden="true" />
                    </div>
                    <p class="ml-3 text-base text-gray-700">
                      10 création de projet/mois
                    </p>
                  </li>
                </ul>
                <div>

                  <button
                    class="inline-flex items-center px-5 pt-4 pb-3.5 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-200 transform hover:-translate-y-1 hover:translate-x-0.5"
                    id="checkout-button-price_1JT0OtFCkda43Xw8OTkjwzuL"
                    role="link"
                    type="button"
                  >
                    Abonnement 25€
                  </button>

                  <div id="error-message"></div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/outline'
import axios from 'axios'
import { useRoute } from 'vue-router'

export default {
  components: {
    CheckIcon,
  },

    data(){
      return {
          user: {}
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
            var stripe = Stripe('pk_test_51IcIjOFCkda43Xw8tZ45QYGDBxJiJoN9f8of0S54aNrCFCS64RZK4ePfee6oP5PJIRac7QCvUOrDYQ9mjMzMMn5r00aR3zRlKb');

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
          var stripe = Stripe('pk_test_51IcIjOFCkda43Xw8tZ45QYGDBxJiJoN9f8of0S54aNrCFCS64RZK4ePfee6oP5PJIRac7QCvUOrDYQ9mjMzMMn5r00aR3zRlKb');

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
              cancelUrl: 'https://example.com/canceled',
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

        getSubscribe(){
          const route = useRoute();
          const session = '';
          if(route.query.session_id){
              session = route.query.session_id;
              console.log(session);
            }
          }

    },

    created(){
        this.loadData();
    },

    mounted(){
        this.loadStripe25();
        this.loadStripe10();
        this.getSubscribe();
    },

}
</script>

<style>

</style>