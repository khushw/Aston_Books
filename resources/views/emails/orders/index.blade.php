<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Email </title>
</head> 
<body>
    This is the Email that is being sent out

    Order ID: {{$order->id}} <br>
    Order Email: {{$order->shipping_email}} <br>
    Order Address: {{$order->shipping_address}} <br>
    ITems ordered:  <br>
    @foreach ($order->products as $product)
        Name: {{$product->title}} <br>
        Price: {{$product->price}} <br>
        Quantity: {{$product->pivot->quantity}} <br>
    @endforeach

</body>
</html>