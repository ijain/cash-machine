<!DOCTYPE html>
<html>
<head>
    <title>Cash Machine - Card Transaction</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <span style="float: left"><a href="{{route('home')}}">back</a></span>
            Credit Card Transaction
        </div>
        <div class="card-body">
            <form name="card-form" id="card-form" method="post" action="/card">
                @csrf
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input placeholder="card number" type="text" id="card-number" name="card-number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiration-date">Expiration Date (MM/YYYY)</label>
                    <input placeholder="expiration date" type="text" id="expiration-date" name="expiration-date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cardholder">Cardholder</label>
                    <input placeholder="cardholder" type="text" id="cardholder" name="cardholder" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input placeholder="cvv" type="text" id="cvv" name="cvv" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input placeholder="amount" type="text" id="amount" name="amount" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
