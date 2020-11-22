
// Create and initialize a payment form object
const paymentForm = new SqPaymentForm({
 // Initialize the payment form elements
 
 //TODO: Replace with your sandbox application ID
 applicationId: applicationId,
 locationId: locationId,
 inputClass: 'sq-input',
 // Customize the CSS for SqPaymentForm iframe elements
 inputStyles: [{
   fontSize: '16px',
   lineHeight: '24px',
   padding: '16px',
   placeholderColor: '#a0a0a0',
   backgroundColor: 'transparent',
 }],
 // Initialize the credit card placeholders
 cardNumber: {
   elementId: 'sq-card-number',
   placeholder: 'Card Number'
 },
 cvv: {
   elementId: 'sq-cvv',
   placeholder: 'CVV'
 },
 expirationDate: {
   elementId: 'sq-expiration-date',
   placeholder: 'MM/YY'
 },
 postalCode: {
   elementId: 'sq-postal-code',
   placeholder: 'Postal'
 },
 // SqPaymentForm callback functions
 callbacks: {
     /*
     * callback function: cardNonceResponseReceived
     * Triggered when: SqPaymentForm completes a card nonce request
     */
    cardNonceResponseReceived: function (errors, nonce, cardData) {
      if(errors){
        console.log(errors);
        return false;
      }

      document.getElementById('cardnonce').value = nonce;
      document.getElementById('pay-form').submit();
    }
  },
  createPaymentRequest: function () {

    return {
      requestShippingAddress: false,
      requestBillingInfo: true,
      currencyCode: "USD",
      countryCode: "US",
      total: {
        label: "MERCHANT NAME",
        amount: document.getElementById('amount').value,
        pending: false
      },
      lineItems: [
        {
          label: "Subtotal",
          amount: document.getElementById('amount').value,
          pending: false
        }
      ]
    }
  },
});


function onGetCardNonce(event) {
  //event.preventDefault();
  paymentForm.requestCardNonce();
}