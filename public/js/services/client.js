console.log('test stripe');

//var stripe = Stripe(process.env.STRIPE_KEY);



// A reference to Stripe.js initialized with your real test publishable API key.
var stripe = Stripe("pk_test_51IbAR1LWV2L3f3Bm7fKrjs2sEnmfMVayfVe7m9CV45UoW5pNxcJKms39OShwKIFwTh4PZOUjjqGPKgqD9dGM4ztp00yhRqHmZM");
// The items the customer wants to buy
var elements = stripe.elements();