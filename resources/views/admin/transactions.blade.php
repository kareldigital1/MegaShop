@extends('base')

@section('title', 'Transactions')

@section('content')
    <div class="d-flex min-vh-100" style="background-color: white;">
        @include('Admin.sidebar')
        <div class="container-fluid">
            <h1>Gestion des Transactions</h1>
            <p>Liste des transactions effectuées.</p>

            <div class="table-responsive bg-white rounded shadow-sm">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ number_format($transaction->amount, 2) }} €</td>
                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
