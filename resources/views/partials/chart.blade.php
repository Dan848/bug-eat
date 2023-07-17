<div class="container px-3">
    <div class="row justify-content-center mt-5">
        <h4 class="text-center">Statistiche Ordini</h4>
        <h6 class="text-center">Ultimo anno</h6>
        <div class="col-12 col-lg-6 my-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Ordini per mese</h3>
                </div>
                <div class="card-body">
                    <canvas id="myOrders"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 my-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Incassi Mensili</h3>
                </div>
                <div class="card-body text-center">
                    <canvas id="myEarns"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{-- SEND DATA TO JS --}}
    @foreach ($orders as $order)
        <div class="orders" data-item-date="{{ $order->month }}" data-item-count="{{ $order->total }}"
            data-item-price="{{ $order->price }}" data-item-restaurant="{{ $order->restaurant_name }}">
        </div>
    @endforeach
</div>
