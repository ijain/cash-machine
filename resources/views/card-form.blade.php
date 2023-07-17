<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cash Machine - Card Transaction</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{route('home')}}/css/bootstrap.min.css">
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
            @if ($errors->has('total'))
                <div class="card-text text-left font-weight-bold" style="padding-bottom: 10px">
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                </div>
            @endif

            <form name="card-form" id="card-form" method="post" action="/card">
                @csrf
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input value="{{ old('card-number') }}" placeholder="card number" type="text" id="card-number" name="card-number" class="form-control">

                    @if ($errors->has('card-number'))
                        <span class="text-danger"><b>{{ $errors->first('card-number') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="expiration-date">Expiration Date (MM/YYYY)</label>
                    <input value="{{ old('expiration-date') }}" placeholder="expiration date" type="text" id="expiration-date" name="expiration-date" class="form-control">

                    @if ($errors->has('expiration-date'))
                        <span class="text-danger"><b>{{ $errors->first('expiration-date') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cardholder">Cardholder</label>
                    <input value="{{ old('cardholder') }}" placeholder="cardholder" type="text" id="cardholder" name="cardholder" class="form-control">

                    @if ($errors->has('cardholder'))
                        <span class="text-danger"><b>{{ $errors->first('cardholder') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input value="{{ old('cvv') }}" placeholder="cvv" type="text" id="cvv" name="cvv" class="form-control">

                    @if ($errors->has('cvv'))
                        <span class="text-danger"><b>{{ $errors->first('cvv') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input value="{{ old('amount') }}" placeholder="amount" type="text" id="amount" name="amount" class="form-control">

                    @if ($errors->has('amount'))
                        <span class="text-danger"><b>{{ $errors->first('amount') }}</b></span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
