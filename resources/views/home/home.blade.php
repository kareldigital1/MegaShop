@extends('base')

@section('title', 'Home')
@section('content')
    <div class="container-fluid " style="background-color: #f8f0ff; padding:100px 15px 100px 15px;">
        <div class="row align-items-center">
            {{-- Texte principal --}}
            <div class="col-md-6">
                <h1 class="fw-bold text-dark" style="font-size: 60px;">
                    Découvrez Notre <span style="color: #8d46c0;">Collection</span> Tendance
                </h1>
                <p class="text-muted fs-5">
                    Les dernières tendances et les meilleurs produits à des prix imbattables. Expédition rapide et service
                    client exceptionnel.
                </p>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg me-3"
                        style="background-color: #8d46c0; border-color: #8d46c0;">Acheter Maintenant</a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">Nouveautés</a>
                </div>
            </div>

            {{-- Image principale --}}
            <div class="col-md-6 d-flex justify-content-end">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1472851294608-062f824d29cc?q=80&w=1000"
                        alt="Collection tendance"
                        class="img-fluid rounded-3 shadow-x5 transform hover:scale-[1.02] transition-transform duration-300"
                        style="max-width: 100%; height: auto; " />
                    <div class="position-absolute bottom-0 end-0 text-white rounded-circle p-3 fw-bold"
                        style="transform: translate(10%, 40%); background-color: #8d46c0; font-size: 20px;">
                        -20%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5">
        <h2 class="text-center fw-bold" style="font-size: 36px;">Catégories Populaires</h2>
        <p class="text-center text-muted mb-4">Explorez notre sélection de produits par catégorie</p>
        <div class="row g-4">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card shadow-sm h-100 position-relative overflow-hidden">
                        <img src="{{ $category->image }}" class="card-img-top" alt="{{ $category->name }}">
                        <div class="overlay"></div>
                        <div
                            class="card-body position-absolute bottom-0 start-50 translate-middle-x text-white text-center">
                            <h5 class="fw-bold">{{ $category->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Produits Vedettes</h2>
                <p class="text-muted">Découvrez notre sélection de produits populaires</p>
            </div>
            <a class="btn btn-outline-dark " href="{{ route('products.index') }}">Voir tout</a>
        </div>

        <div class="row g-4">
            @foreach ($featuredProducts as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="position-relative">
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="position-absolute top-0 start-0 p-2">
                                @if ($product->is_new)
                                    <span class="badge bg-primary">Nouveau</span>
                                @endif
                                @if ($product->is_sale)
                                    <span class="badge bg-danger ms-1">Promo</span>
                                @endif
                            </div>
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-star text-warning"></i> {{ $product->rating ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ number_format($product->price, 2) }} FCFA</strong>
                                    @if ($product->old_price)
                                        <span class="text-muted text-decoration-line-through">
                                            {{ number_format($product->old_price, 2) }} FCFA
                                        </span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn cart-icon" style="border-color: #8d46c0;">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
