<!DOCTYPE html>
{{--  --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-details h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .order-details p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .purchase-btn {
            display: flex;
            align-items: center;
        }

        .purchase-btn button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .purchase-btn button:hover {
            background-color: #218838;
        }

    </style>
    <title>Document</title>
</head>
@inject('order','App\Models\Order' )

<body>
    {{-- @foreach ($order->all() as $order ) --}}
    <div class="container">
        <h1>Orders</h1>
        @foreach ($order->all() as $order )
            
        <div class="order-item">
            <div class="order-details">
                <h2>
                    @foreach ($order->products as $product )
                       <span class='badge badge-success'>{{ $product->name }}</span> 
                    @endforeach
                </h2>
                <p>Order ID: {{ $order->id }}</p>
                <p>Price: {{ $order->total_price }}</p>
                <p>Status: {{ $order->status->name }}</p>
            </div>
            <form action="{{ route('paypal') }}" method="post">
                @csrf
                @foreach ($order->products as $product )
        
                <div>
                    <input type="hidden" name="name" value="{{ $product->name }}">
                </div>
                <div>
                    <input type="hidden" name="quantity" value="{{ $product->pivot->quantity }}">
                </div>
                @endforeach
                <div>
                    <input type="hidden" name="price" value="{{ $order->total_price }}">
                </div>
                
                <div class="purchase-btn">
                    <button>Purchase</button>
                </div>
            </form>
        </div>
        @endforeach
    </div>

</body>
</html>
