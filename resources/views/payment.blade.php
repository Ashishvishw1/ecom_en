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
         
            <form action="{{route('make.order')}}" method="post">
              @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Amount</label>
                  <input type="text" value=" {{$total+10}}" name="amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
              
                      
           
               
                </div>
               
              <br>
                <button type="submit" class="btn btn-primary">Make Payment</button>
              </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
