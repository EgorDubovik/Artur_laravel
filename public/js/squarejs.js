
// Create and initialize a payment form object
const paymentForm = new SqPaymentForm({
 // Initialize the payment form elements
 
 //TODO: Replace with your sandbox application ID
 applicationId: applicationId,
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
      alert(`The generated nonce is:\n${nonce}`);
    }
  });


function onGetCardNonce(event) {
  paymentForm.requestCardNonce();
}