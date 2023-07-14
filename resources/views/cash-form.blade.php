<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cash Machine - Cash Transaction</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{route('home')}}/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    @if ($errors->has('total'))
        <span class="text-danger">{{ $errors->first('total') }}</span>
    @endif

    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <span style="float: left"><a href="{{route('home')}}">back</a></span>
            Cash Transaction (limit 10.000)
        </div>
        <div class="card-body">
            <form name="cash-form" id="cash-form" method="post" action="/cash">
                @csrf
                <div class="form-group">
                    <label for="bills[1]">banknote 1</label>
                    <input  placeholder="add quantity" type="number" id="bills[1]" name="bills[1]" class="form-control">
                    @if ($errors->has('bills.1'))
                        <span class="text-danger">{{ $errors->first('bills.1') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="bills[5]">banknote 5</label>
                    <input value="{{ old('bills.5') ?? 0 }}" placeholder="add quantity" type="number" id="bills[5]" name="bills[5]" class="form-control" required>
                    @if ($errors->has('bills.5'))
                        <span class="text-danger">{{ $errors->first('bills.5') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="bills[10]">banknote 10</label>
                    <input value="{{ old('bills.10') ?? 0 }}" placeholder="add quantity" type="number" id="bills[10]" name="bills[10]" class="form-control" required>
                    @if ($errors->has('bills.10'))
                        <span class="text-danger">{{ $errors->first('bills.10') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="bills[50]">banknote 50</label>
                    <input value="{{ old('bills.50') ?? 0 }}" placeholder="add quantity" type="number" id="bills[50]" name="bills[50]" class="form-control" required>
                    @if ($errors->has('bills.50'))
                        <span class="text-danger">{{ $errors->first('bills.50') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="bills[100]">banknote 100</label>
                    <input value="{{ old('bills.100') ?? 0 }}" placeholder="add quantity" type="number" id="bills[100]" name="bills[100]" class="form-control" required>
                    @if ($errors->has('bills.100'))
                        <span class="text-danger">{{ $errors->first('bills.100') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
