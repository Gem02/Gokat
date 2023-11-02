const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_90843aff34ae2921bbe4622a6241972f6c96761e', // Replace with your public key
    email: document.getElementById("email").value,
    firstname: document.getElementById("cname").value,
    amount: document.getElementById("amount").value * 100,
    currency: 'NGN',
    ref: 'GOKA'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Transaction Canceld.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/gokatsite/verify_payment.php?reference=" + response.reference;
    }
  });

  handler.openIframe();
}