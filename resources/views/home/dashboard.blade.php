@extends('base')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
    @include('Admin.Sidebar')

        <!-- Main Content -->
        <div class="container-fluid py-4">
            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold">Bonjour, Admin</h2>
                <p class="text-muted">Voici un aperçu de votre boutique aujourd'hui</p>
            </div>

            <!-- Stats Overview -->
            <div class="row g-4">
                @php
                    $stats = [
                        [
                            'title' => 'Ventes Totales',
                            'value' => number_format($totalSales, 2) . '€',
                            'change' => '+12.5%',
                            'changeClass' => 'text-success',
                        ],
                        [
                            'title' => 'Commandes',
                            'value' => $totalOrders,
                            'change' => '+8.2%',
                            'changeClass' => 'text-success',
                        ],
                        [
                            'title' => 'Clients',
                            'value' => $totalCustomers,
                            'change' => '+4.7%',
                            'changeClass' => 'text-success',
                        ],
                        [
                            'title' => 'Panier Moyen',
                            'value' => number_format($averageCartValue, 2) . '€',
                            'change' => '-2.1%',
                            'changeClass' => 'text-danger',
                        ],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-header text-muted small fw-semibold">{{ $stat['title'] }}</div>
                            <div class="card-body">
                                <h5 class="card-title text-2xl fw-bold">{{ $stat['value'] }}</h5>
                                <p class="text-muted small mt-1">
                                    <span class="{{ $stat['changeClass'] }}">{{ $stat['change'] }}</span> depuis le mois
                                    dernier
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Charts Section -->
            <div class="row g-4 mt-4">
                <!-- Revenue Chart -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Revenus Mensuels</span>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-calendar me-2"></i> Filtrer
                            </button>
                        </div>
                        <div class="card-body">
                            <canvas id="revenue-chart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Orders Chart -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Commandes cette semaine</span>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-calendar me-2"></i> Filtrer
                            </button>
                        </div>
                        <div class="card-body">
                            <canvas id="orders-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <!-- Category Chart -->
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="height: 350px;">
                        <div class="card-header">Ventes par catégorie</div>
                        <div class="card-body">
                            <canvas id="category-chart" width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="col-lg-6">
                    <div class="card shadow-sm" style="height: 100%;">
                        <div class="card-header">Activités Récentes</div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                @foreach ($recentActivities as $activity)
                                    <li class="d-flex align-items-start mb-3">
                                        <div class="icon {{ $activity['bg'] }} text-white rounded-circle me-3">
                                            <i class="fa {{ $activity['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ $activity['text'] }}</p>
                                            <small class="text-muted">{{ $activity['time'] }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <!-- Recent Orders -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Activité récente</h5>
                            <i class="fa fa-wave-pulse text-muted"></i>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Commandes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nouveaux clients</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled">
                                @foreach ($recentOrders as $order)
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <p class="mb-0 fw-bold">Commande #{{ $order->id }}</p>
                                            <small class="text-muted">Il y a
                                                {{ $order->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="badge bg-success">{{ $order->status }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Produits populaires</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                @foreach ($popularProducts as $product)
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px;">
                                                {{ $product->name[0] }}
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">{{ $product->name }}</p>
                                                <small class="text-muted">{{ $product->stock }} en stock</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-arrow-up text-success me-2"></i>
                                            <span class="fw-bold">{{ $product->sales_count }} ventes</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
