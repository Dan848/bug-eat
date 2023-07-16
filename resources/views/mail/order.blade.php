<h1> Nuovo ordine N# {{ $order['number'] }} </h1>
<h3>Prodotti ordinati</h3>
<div>
    @foreach ($order['products'] as $product)
        <div>{{ $product['name'] }} -----> <span>{{ $product['quantity'] }}</span>x<span>{{ $product['price'] }}€</span>
            <span>{{ number_format(floatval($product['quantity'] * $product['price']), 2) }}€</span>
        </div><br>
    @endforeach
</div>
<div>
    <strong>Totale: <span>{{ $order['total_price'] }}</span></strong>
</div>
