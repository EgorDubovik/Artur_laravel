
// Create and initialize a payment form object
const paymentForm = new SqPaymentForm({
 // Initialize the payment form elements
 
 //TODO: Replace with your sandbox application ID
 applicationId: "REPLACE_WITH_APPLICATION_ID",
 inputClass: 'sq-input',
 autoBuild: false,
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
     if (errors) {
         // Log errors from nonce generation to the browser developer console.
         console.error('Encountered errors:');
         errors.forEach(function (error) {
             console.error('  ' + error.message);
         });
         alert('Encountered errors, check browser developer console for more details');
          setPayButtonDisableState(false)
          return;
     }
        alert(`The generated nonce is:\n${nonce}`);
        setPayButtonDisableState(false);
        //TODO: Replace alert with code in step 2.1
     }
 }
});