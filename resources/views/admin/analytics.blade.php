@extends('base')

@section('title', 'Statistiques')

@section('content')
    <div class="d-flex min-vh-100" style="background-color: white;">
        @include('Admin.sidebar')
        <div class="container-fluid">
            <h1>Statistiques</h1>
            <p>Contenu de la page des statistiques.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total des commandes</h5>
                            <p class="card-text">{{ \App\Models\Order::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Revenu total</h5>
                            <p class="card-text">{{ number_format(\App\Models\Order::sum('total_price'), 2) }} FCFA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Clients actifs</h5>
                            <p class="card-text">{{ \App\Models\Customer::where('status', 'active')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
