<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cash Machine - Bank Transaction</title>
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
            Bank Transfer Transaction
        </div>
        <div class="card-body">
            <form name="bank-form" id="bank-form" method="post" action="/bank">
                @csrf
                <div class="form-group">
                    <label for="transfer-date">Transfer Date</label>
                    <input placeholder="transfer date" type="text" id="transfer-date" name="transfer-date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="customer-name">Customer Name</label>
                    <input placeholder="customer name" type="text" id="customer-name" name="customer-name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="account-number">Account Number</label>
                    <input placeholder="account number" type="text" id="account-number" name="account-number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input placeholder="amount" type="text" id="amount" name="amount" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
