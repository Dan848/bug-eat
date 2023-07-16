<h1> Ordine Numero:{{$lead->order_id}} confermato</h1>
    @foreach ($lead->produtcs as $item)
        <div>
            <span>
                {{$item["name"]}}
            </span>
            <span>
                {{$item["quantity"]}} x
            </span>
            <span>
                {{$item["price"]}}€
            </span>
            <span>
                {{$item["quantity"]*$item["price"]}}
            </span>
        </div>
    @endforeach

    <div> Totale: {{$lead->total}}</div>
