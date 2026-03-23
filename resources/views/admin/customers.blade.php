@extends('base')

@section('title', 'Gestion des Clients')

@section('content')
    <div class="d-flex min-vh-100" style="background-color: white;">
        <!-- Sidebar -->
        @include('Admin.sidebar')

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="mb-4">
                <h2 class="fw-bold">Clients</h2>
                <p class="text-muted">Gérez votre base de clients et suivez leur activité</p>
            </div>

            <!-- Search and Add Button -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-column flex-md-row gap-3">
                    <div class="flex-grow-1 position-relative">
                        <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" id="searchQuery" class="form-control ps-5"
                            placeholder="Rechercher un client...">
                    </div>
                    <button class="btn btn-purple" style="border-color: #8d46c0;">
                        <i class="fa fa-user-plus me-2"></i> Ajouter un client
                    </button>
                </div>
            </div>

            <!-- Customers Table -->
            <div class="table-responsive bg-white rounded shadow-sm">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Client</th>
                            <th>Inscrit le</th>
                            <th>Commandes</th>
                            <th class="text-end">Dépensé</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customersTable">
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-3">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $customer->name }}</p>
                                            <p class="mb-0 text-muted small">{{ $customer->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($customer->join_date)->format('d/m/Y') }}</td>
                                <td>{{ $customer->total_orders }}</td>
                                <td class="text-end">{{ number_format($customer->total_spent, 2) }} FCFA</td>
                                <td>
                                    <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $customer->status === 'active' ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary"
                                        onclick="viewCustomerDetails({{ $customer->id }})">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-envelope"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
