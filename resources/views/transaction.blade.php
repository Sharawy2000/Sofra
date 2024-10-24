<!-- resources/views/transaction.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <!-- Add any required CSS here -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Proceed with Payment</h1>

        <form action="{{ route('processTransaction') }}" method="POST">
            @csrf
            <!-- You can pass additional data such as amount, user details, etc. -->
            <input type="hidden" name="amount" value="100">
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>

    <!-- Add any required JavaScript here -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
