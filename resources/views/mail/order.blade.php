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






<h1>Ricevuta di conferma dell'ordine - Conferma Ordine N#{{ $order['number'] }}</h1>
<p>Salve,</p>
<p>Grazie per aver scelto Bug-Eat! Siamo lieti di confermare la ricezione del tuo ordine. Di seguito troverai
    i dettagli dell'ordine effettuato:</p>

<p><strong>Numero ordine:</strong> {{ $order['number'] }}</p>

<h3>Dettagli prodotti ordinati:</h3>
@foreach ($order['products'] as $product)
    <div>
        <p>{{ $product['name'] }}: {{ $product['quantity'] }} x {{ $product['price'] }}€ =
            <strong>{{ number_format(floatval($product['quantity'] * $product['price']), 2) }}€</strong>
        </p>



    </div>
@endforeach

<div>
    <p>Totale:<strong> {{ number_format(floatval($order['total_price']), 2) }}€</strong></p>
</div>



<h3>Indirizzo di consegna: <strong>{{ $order['shipment_address'] }}</strong> ,
</h3>

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
