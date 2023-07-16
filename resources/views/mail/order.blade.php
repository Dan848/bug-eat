{{-- <h1> Nuovo ordine N# {{ $order['number'] }} </h1>
<h3>Prodotti ordinati</h3>
<div>
    @foreach ($order['products'] as $product)
        <div>{{ $product['name'] }} -----> <span>{{ $product['quantity'] }}</span>x<span>{{ $product['price'] }}€</span>
            <span>{{ number_format(floatval($product['quantity'] * $product['price']), 2) }}€</span>
        </div><br>
    @endforeach
</div>
<div>
    <strong>Totale: <span>{{ number_format(floatval($order['total_price']), 2) }}€</span></strong>
</div> --}}
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #ff7043;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ricevuta di conferma dell'ordine - Conferma Ordine N#{{ $order['number'] }}</h1>
        <p>Gentile Cliente {{ $user['name'] }},</p>
        <p>Grazie per aver scelto Deliveroo! Siamo lieti di confermare la ricezione del tuo ordine. Di seguito troverai
            i dettagli dell'ordine effettuato:</p>

        <p><strong>Numero ordine:</strong> {{ $order['number'] }}</p>

        <h3>Dettagli prodotti ordinati:</h3>
        @foreach ($order['products'] as $product)
            <div class="product">
                <p>{{ $product['name'] }}: {{ $product['quantity'] }} * {{ $product['price'] }}€</p>
            </div>
        @endforeach

        <div class="total">
            <p><strong>Totale:</strong> {{ number_format(floatval($order['total_price']), 2) }}€</p>
        </div>



        <h3>Indirizzo di consegna:</h3>
        <p>{{ $order['delivery_address']['name'] }}</p>

        <p>{{ $order['delivery_address']['city'] }}, {{ $order['delivery_address'] }}</p>

        <p>Grazie per aver effettuato il tuo ordine! Desideriamo condividere con te una notizia speciale: grazie al tuo
            contributo, verrà piantato un albero attraverso la collaborazione con una fondazione impegnata nella
            riforestazione. Inoltre, una parte dei ricavi sarà devoluta in donazioni a preziose associazioni che si
            dedicano alla protezione delle api, creature vitali per l'equilibrio dell'ecosistema. Il tuo supporto non
            solo ti permette di gustare deliziosi piatti, ma contribuisce anche attivamente alla conservazione
            dell'ambiente e alla promozione della biodiversità. Apprezziamo la tua scelta consapevole e l'impatto
            positivo che generi. Grazie ancora per aver scelto il nostro servizio e per essere parte di questa
            importante iniziativa!</p>
        <p>Si prega di tenere presente che l'orario stimato di consegna è indicativo e potrebbe variare leggermente a
            causa di fattori esterni. Faremo del nostro meglio per consegnare il tuo ordine nel minor tempo possibile.
        </p>

        <p>In caso di domande o necessità di assistenza, il nostro servizio clienti è a tua disposizione. Puoi
            contattarci tramite il numero di telefono o l'indirizzo email forniti sul nostro sito web.</p>

        <p>Grazie ancora per aver scelto Bug-Eat. Speriamo che tu possa goderti il tuo pasto!</p>

        <p>Cordiali saluti,</p>

        <p>Il team di Bug-Eat</p>
    </div>
</body>

</html>
