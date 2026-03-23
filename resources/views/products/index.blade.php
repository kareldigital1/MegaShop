@extends('base')

@section('title', 'Tous les produits')

@section('content')
    <div class="container-fluid my-5">
        <h1 class="fw-bold">Tous les produits</h1>
        <p class="text-muted">Découvrez notre sélection de produits de qualité</p>
        <div class="row">
            <!-- Filtres -->
            <div class="col-md-3">
                <div class="filtre-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Filtres</h5>
                        <a href="{{ route('products.index') }}" class="text-decoration-none text-dark"><i
                                class="fa-solid fa-rotate-right"></i></a>
                    </div>
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                    </div>
                    <h6 class="fw-bold">Catégories</h6>

                    @foreach ($categories as $categorie)
                        <ul class="list-unstyled">
                            <li>
                                <input type="checkbox" class="form-check-input me-2" value="{{ $categorie->id }}"
                                    id="categorie-{{ $categorie->id }}">
                                <label for="categorie-{{ $categorie->id }}">{{ $categorie->name }}</label>
                            </li>
                        </ul>
                    @endforeach

                    <hr>
                </div>
            </div>

            <!-- Produits -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p id="productCount" class="text-muted">{{ $produits->count() }} produit(s) trouvé(s)</p>
                    <select id="sortSelect" class="form-select w-auto">
                        <option>Recommandés</option>
                        <option>Prix croissant</option>
                        <option>Prix décroissant</option>
                    </select>
                </div>
                <div class="row g-4">
                    @forelse ($produits as $produit)
                        <div class="col-md-4" data-category-id="{{ $produit->category_id }}">
                            <div class="card">
                                <div class="position-relative">
                                    <img src="{{ asset($produit->image) }}" class="card-img-top" alt="{{ $produit->name }}">
                                    <div class="position-absolute top-0 start-0 p-2">
                                        @if ($produit->is_new)
                                            <span class="badge bg-primary">Nouveau</span>
                                        @endif
                                        @if ($produit->is_sale)
                                            <span class="badge bg-danger ms-1">Promo</span>
                                        @endif
                                    </div>
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-light text-dark">
                                            {{ $produit->rating ?? 'N/A' }} <i class="fas fa-star text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->name }}</h5>
                                    <p class="card-text text-muted">{{ $produit->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ number_format($produit->price, 2) }} FCFA</strong>
                                            @if ($produit->old_price)
                                                <span class="text-muted text-decoration-line-through">
                                                    {{ number_format($produit->old_price, 2) }} FCFA
                                                </span>
                                            @endif
                                        </div>
                                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $produit->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn cart-icon" style="border-color: #8d46c0;">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">Aucun produit trouvé.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="categorie-"]');
    const productCards = document.querySelectorAll('.col-md-4');
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const productCount = document.getElementById('productCount');
    const container = document.querySelector('.row.g-4');

    function sortProducts() {
        const sortValue = sortSelect.value;
        const cards = Array.from(container.children);
        cards.sort((a, b) => {
            const priceA = parseFloat(a.querySelector('strong').textContent.replace(' FCFA', '').replace(',', ''));
            const priceB = parseFloat(b.querySelector('strong').textContent.replace(' FCFA', '').replace(',', ''));
            if (sortValue === 'Prix croissant') {
                return priceA - priceB;
            } else if (sortValue === 'Prix décroissant') {
                return priceB - priceA;
            } else {
                return 0; // Recommandés, pas de tri
            }
        });
        cards.forEach(card => container.appendChild(card));
    }

    function filterProducts() {
        const selectedCategories = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
        const query = searchInput.value.toLowerCase();
        let visibleCount = 0;
        productCards.forEach(card => {
            const categoryId = card.getAttribute('data-category-id');
            const name = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-text').textContent.toLowerCase();
            const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(categoryId);
            const matchesSearch = name.includes(query) || description.includes(query);
            if (matchesCategory && matchesSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        productCount.textContent = `${visibleCount} produit(s) trouvé(s)`;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', filterProducts));
    searchInput.addEventListener('input', filterProducts);
    sortSelect.addEventListener('change', () => {
        sortProducts();
        filterProducts();
    });
});
</script>
