<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cash Machine - Bank Transaction</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{route('home')}}/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <span style="float: left"><a href="{{route('home')}}">back</a></span>
            Bank Transfer Transaction
        </div>
        <div class="card-body">
            @if ($errors->has('total'))
                <div class="card-text text-left font-weight-bold" style="padding-bottom: 10px">
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                </div>
            @endif

            <form name="bank-form" id="bank-form" method="post" action="/bank">
                @csrf
                <div class="form-group">
                    <label for="transfer-date">Transfer Date</label>
                    <input value="{{ old('transfer-date') }}" placeholder="transfer date" type="text" id="transfer-date" name="transfer-date" class="form-control">

                    @if ($errors->has('transfer-date'))
                        <span class="text-danger"><b>{{ $errors->first('transfer-date') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="customer-name">Customer Name</label>
                    <input value="{{ old('customer-name') }}" placeholder="customer name" type="text" id="customer-name" name="customer-name" class="form-control">

                    @if ($errors->has('customer-name'))
                        <span class="text-danger"><b>{{ $errors->first('customer-name') }}</b></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="account-number">Account Number</label>
                    <input value="{{ old('account-number') }}" placeholder="account number" type="text" id="account-number" name="account-number" class="form-control">

                    @if ($errors->has('account-number'))
                        <span class="text-danger"><b>{{ $errors->first('account-number') }}</b></span>
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
