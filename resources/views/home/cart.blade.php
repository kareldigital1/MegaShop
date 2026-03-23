{{-- filepath: c:\Laravels\MegaShop\resources\views\home\cart.blade.php --}}
@extends('base')
@section('title', 'cart')
@section('content')
    <div class="container-fluid my-5">
        <h1 class="mb-4">Panier</h1>
        <div class="row">
            <!-- Tableau des produits -->
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                                            class="img-thumbnail" style="width: 80px; height: 80px;">
                                        <div class="ms-3">
                                            <h5>{{ $item->product->name }}</h5>
                                            <p class="text-muted">
                                                {{ $item->product->category->name ?? 'Non défini' }}
                                            </p>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->product->price, 2) }} FCFA</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="text" value="{{ $item->quantity }}"
                                            class="form-control text-center mx-2" style="width: 50px;" readonly>
                                    </div>
                                </td>
                                <td>{{ number_format($item->product->price * $item->quantity, 2) }} FCFA</td>
                            </tr>
                        @endforeach
                        <tr>
                            <a href="{{ route('products.index') }}" class="btn btn-link text-decoration-none"
                                style="color: #8d46c0; font-family: 'Poppins', sans-serif;">
                                <i class="fa-solid fa-cart-plus"></i> Continuer vos achats
                            </a>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Récapitulatif -->
            <div class="col-md-4">
                <div class="recap-card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold fs-4">Récapitulatif</h5>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Sous-total</span>
                                <span>{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                                    FCFA</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Livraison</span>
                                <span>Gratuite</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                                    FCFA</span>
                            </li>
                        </ul>
                        <div class="input-group mt-3">
                            <input type="text" id="promo-code" class="form-control" placeholder="Code promo"
                                aria-label="Code promo">
                            <button id="apply-button" class="btn" type="button"
                                style="background-color: #d6b3f9; color: white;">Appliquer</button>
                        </div>
                        <button class="btn w-100 mt-3 fw-bold" type="button"
                            style="background-color: #8d46c0; color: white; font-size: 16px; border-radius: 5px;">
                            Commander <i class="fas fa-arrow-right ms-3"></i>
                        </button>
                        <div class="text-center mt-3">
                            <small>Nous acceptons :</small>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <img src="https://cdn.shopify.com/s/assets/payment_icons/visa-319d545c6fd255c9aad5eeaad21fd6f7f7b4fdbdb1a35ce83b89cca12a187f00.svg"
                                    alt="Visa" class="me-2">
                                <img src="https://cdn.shopify.com/s/assets/payment_icons/master-173035bc8124581983d4efa50cf8626e8553c2b311353fbf67485f9c1a2b88d1.svg"
                                    alt="MasterCard" class="me-2">
                                <img src="https://cdn.shopify.com/s/assets/payment_icons/paypal-49e4c1e03244b6d2de0d270ca0d22dd15da6e92cc7266e93eb43762df5aa355d.svg"
                                    alt="PayPal" class="me-2">
                                <img src="https://cdn.shopify.com/s/assets/payment_icons/apple_pay-f6db0077dc7c325b436ecbdcf254239100b35b70b1663bc7523d7c424901fa09.svg"
                                    alt="Apple Pay">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


