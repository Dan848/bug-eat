<div class="container d-flex justify-content-center  my-5">
    <div class="card ">
        <h6 class="card-header">
            Errore
        </h6>
        <div class="card-body">
            <h1 class="card-title text-center">
                Ooops!
            </h1>
            <div class="text-center pb-3">
                <h4 class=" mb-3">Pare che tu non abbia ancora un ristorante</h4>
                <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary"><i
                        class="fa-solid fa-plus me-2"></i>Crea il tuo ristorante</a>
            </div>
        </div>
    </div>
</div>
