@extends('base')

@section('title', 'Produits')

@section('content')
    <div class="d-flex min-vh-100" style="background-color: white;">
        @include('Admin.sidebar')
        <div class="container-fluid mt-4">
            <h1 class="fw-bold">Gestion des Produits</h1>
            <p class="text-muted">Gérez votre catalogue de produits</p>

            <!-- Bouton Ajouter un produit -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-2xl fw-bold">Produits</h2>
                <button class="btn btn-purple" style="border-color: #8d46c0;" data-bs-toggle="modal" data-bs-target="#addEditProductModal">
                    <i class="fa fa-plus me-2"></i> Ajouter un produit
                </button>
            </div>

            <!-- Barre de recherche et filtres -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-column flex-md-row gap-3">
                    <div class="flex-grow-1 position-relative">
                        <i class="fa fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" id="searchQuery" class="form-control ps-5"
                            placeholder="Rechercher un produit...">
                    </div>
                    <select class="form-select w-auto">
                        <option selected>Toutes les catégories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select w-auto">
                        <option selected>Tous les statuts</option>
                        <option value="in-stock">En stock</option>
                        <option value="out-of-stock">Rupture de stock</option>
                    </select>
                </div>
            </div>

            <!-- Tableau des produits -->
            <div class="table-responsive bg-white rounded shadow-sm">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Slug</th>
                            <th>SKU</th>
                            <th class="text-end">Prix</th>
                            <th class="text-center">Stock</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTable">
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded me-3" style="width: 50px; height: 50px;">
                                        @else
                                            <div class="avatar bg-primary text-white rounded-circle me-3">
                                            <i class="fa fa-box"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $product->name }}</p>
                                            <small class="text-muted">{{ $product->description }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category->name ?? 'Non défini' }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ $product->sku ?? 'N/A' }}</td>
                                <td class="text-end">{{ number_format($product->price, 2) }} FCFA</td>
                                <td class="text-center">
                                    @if ($product->stock > 3)
                                        <span class="badge bg-success">En stock</span>
                                    @else
                                        <span class="badge bg-danger">Rupture</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->is_featured)
                                        <span class="badge bg-secondary">Vedette</span>
                                    @endif
                                    @if ($product->is_new)
                                        <span class="badge bg-primary">Nouveau</span>
                                    @endif
                                    @if ($product->is_sale)
                                        <span class="badge bg-danger">Solde</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="actionsDropdown{{ $product->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="actionsDropdown{{ $product->id }}">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#addEditProductModal" data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}" data-slug="{{ $product->slug }}"
                                                    data-short-description="{{ $product->short_description }}"
                                                    data-description="{{ $product->description }}"
                                                    data-price="{{ $product->price }}"
                                                    data-cost-price="{{ $product->cost_price }}"
                                                    data-stock="{{ $product->stock }}" 
                                                    data-sku="{{ $product->sku }}"
                                                    data-category-id="{{ $product->category_id }}"
                                                    data-is-featured="{{ $product->is_featured }}"
                                                    data-is-new="{{ $product->is_new }}"
                                                    data-is-sale="{{ $product->is_sale }}"
                                                    data-image="{{ $product->image }}">
                                                    <i class="fa fa-edit me-2"></i> Modifier
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fa fa-trash me-2"></i> Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter/Modifier un produit -->
    <div class="modal fade" id="addEditProductModal" tabindex="-1" aria-labelledby="addEditProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEditProductModalLabel">Ajouter/Modifier un produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="POST">

                        <!-- Nom du produit -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" id="productName" name="name"
                                placeholder="Nom du produit" required>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="productSlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="productSlug" name="slug"
                                placeholder="Slug unique du produit">
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Catégorie</label>
                            <select class="form-select" id="productCategory" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Image du produit -->
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Image du produit</label>
                            <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                            <div id="imagePreview" class="mt-2"></div>
                        </div>

                        <!-- Courte description -->
                        <div class="mb-3">
                            <label for="productShortDescription" class="form-label">Courte description</label>
                            <textarea class="form-control" id="productShortDescription" name="short_description" rows="2"
                                placeholder="Courte description du produit"></textarea>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" name="description" rows="3"
                                placeholder="Description complète du produit"></textarea>
                        </div>

                        <!-- Prix -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="productPrice" class="form-label">Prix (FCFA)</label>
                                <input type="number" class="form-control" id="productPrice" name="price"
                                    placeholder="0.00" step="0.01" required>
                            </div>
                            <div class="col-md-4">
                                <label for="productCostPrice" class="form-label">Prix de revient (FCFA)</label>
                                <input type="number" class="form-control" id="productCostPrice" name="cost_price"
                                    placeholder="0.00" step="0.01">
                            </div>
                            <div class="col-md-4">
                                <label for="productStock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="productStock" name="stock"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <!-- SKU -->
                        <div class="mb-3">
                            <label for="productSku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="productSku" name="sku"
                                placeholder="Code unique du produit">
                        </div>

                        <!-- Statuts -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isFeatured" name="is_featured">
                                    <label class="form-check-label" for="isFeatured">Produit en vedette</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isNew" name="is_new">
                                    <label class="form-check-label" for="isNew">Nouveau produit</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isSale" name="is_sale">
                                    <label class="form-check-label" for="isSale">Produit en solde</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-purple" style="border-color: #8d46c0;" form="productForm">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
