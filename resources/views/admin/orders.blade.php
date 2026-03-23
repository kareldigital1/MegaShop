@extends('base')

@section('title', 'Commandes')

@section('content')
<div class="d-flex min-vh-100" style="background-color: white;">
    @include('Admin.sidebar')
    <div class="container-fluid py-4">
        <h1 class="fw-bold">Gestion des Commandes</h1>
        <p class="text-muted">Gérez et suivez toutes les commandes</p>

        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Paiement</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ ucfirst($order->payment_status) }}</td>
                            <td class="text-end">{{ number_format($order->total_price, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
