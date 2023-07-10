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
            Credit Card Transaction Confirmation
        </div>
        <div class="card-body">
            <div class="form-group">
                test
            </div>
            <div class="form-group">
                test 2
            </div>
        </div>
    </div>
</div>
</body>
</html>
