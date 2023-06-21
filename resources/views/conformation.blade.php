<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <title>Payment</title>


  
<div class="container mt-5">
  
    <div class="row">
        <div class="col-sm-4">
          <h3 class="text-center">Make Payment</h3>
          <br>
          <div class="center-block well" style="width: 500px">
          
                <div class="mb-3">
                 <p><strong>Order ID::</strong>{{$orderid}}</p>
                 <p><strong>Amount:</strong>{{number_format($razorpayOrder->amount / 100,2)}}</p>
           
               
                </div>
               
              <br>
                <button type="submit" class="btn btn-primary" id="rzp-button1">Paynow</button>

        </div>
    </div>
</div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var Urls= "{{route('success')}}"
var options = {
    "key": "rzp_test_TixgzEzxWCouVt", // Enter the Key ID generated from the Dashboard
    "amount": {{$razorpayOrder->amount}}, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Acme Corp",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "{{$razorpayOrder->id}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){

        window.location.href =Urls+'?payment_id='+response.razorpay_payment_id;
    },
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
</body>
</html>
