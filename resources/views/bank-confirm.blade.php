<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cash Machine - Bank Transfer Transaction Confirmation</title>
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
            Bank Transfer Transaction Data
        </div>
        <div class="card-body">
            <div class="form-group">
                ID: {{$transaction->id ?? 0}}
            </div>
            <div class="form-group">
                Inputs: {{json_encode($transaction->inputs ?? [])}}
            </div>
            <div class="form-group">
                Total Amount: {{$transaction->total ?? 0}}
            </div>
        </div>
    </div>
</div>
</body>
</html>
