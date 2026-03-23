@extends('base')

@section('title', 'Paramètres')

@section('content')
<div class="d-flex min-vh-100" style="background-color: white;">
    @include('Admin.sidebar')
    <div class="container-fluid py-4">
        <h1 class="fw-bold">Paramètres</h1>
        <p class="text-muted">Gérez la configuration de votre boutique en ligne</p>

        <!-- Onglets -->
        <ul class="nav nav-tabs mb-4 " id="settingsTabs" role="tablist">
            <li class="nav-item " role="presentation">
                <button class="nav-link active text-muted fw-bold" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">Général</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-muted fw-bold" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">Paiement</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-muted fw-bold" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Livraison</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-muted fw-bold" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">Notifications</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-muted fw-bold" id="taxes-tab" data-bs-toggle="tab" data-bs-target="#taxes" type="button" role="tab" aria-controls="taxes" aria-selected="false">Taxes</button>
            </li>
        </ul>

        <!-- Contenu des onglets -->
        <div class="tab-content" id="settingsTabsContent">
            <!-- Général -->
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Information de la boutique</h5>
                        <p class="card-text">Ces informations apparaîtront sur votre site et dans les emails.</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="storeName" class="form-label">Nom de la boutique</label>
                                    <input type="text" class="form-control" id="storeName" value="MegaShop">
                                </div>
                                <div class="col-md-6">
                                    <label for="storeEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="storeEmail" value="contact@megashop.com">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="storePhone" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" id="storePhone" value="+33 1 23 45 67 89">
                                </div>
                                <div class="col-md-6">
                                    <label for="storeCurrency" class="form-label">Devise</label>
                                    <select class="form-select" id="storeCurrency">
                                        <option value="eur" selected>Euro (€)</option>
                                        <option value="usd">Dollar américain ($)</option>
                                        <option value="gbp">Livre sterling (£)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="storeAddress" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="storeAddress" value="15 Rue du Commerce">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="storeCity" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="storeCity" value="Paris">
                                </div>
                                <div class="col-md-4">
                                    <label for="storeZip" class="form-label">Code postal</label>
                                    <input type="text" class="form-control" id="storeZip" value="75000">
                                </div>
                                <div class="col-md-4">
                                    <label for="storeCountry" class="form-label">Pays</label>
                                    <select class="form-select" id="storeCountry">
                                        <option value="fr" selected>France</option>
                                        <option value="be">Belgique</option>
                                        <option value="ch">Suisse</option>
                                        <option value="ca">Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-purple">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Paiement -->
            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Méthodes de paiement</h5>
                        <p class="card-text">Configurez les options de paiement disponibles pour vos clients.</p>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="creditCard" checked>
                            <label class="form-check-label" for="creditCard">Carte de crédit</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="paypal">
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="bankTransfer" checked>
                            <label class="form-check-label" for="bankTransfer">Virement bancaire</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-purple">Enregistrer les modifications</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Livraison -->
            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Options de livraison</h5>
                        <p class="card-text">Configurez les méthodes de livraison proposées.</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="standardShipping" class="form-label">Livraison standard</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="standardShipping" value="4.99" min="0" step="0.01">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="expressShipping" class="form-label">Express</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="expressShipping" value="9.99" min="0" step="0.01">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-purple">Enregistrer les modifications</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Notifications par email</h5>
                        <p class="card-text">Configurez les emails automatiques envoyés aux clients.</p>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="orderConfirmation" checked>
                            <label class="form-check-label" for="orderConfirmation">Confirmation de commande</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="shippingConfirmation" checked>
                            <label class="form-check-label" for="shippingConfirmation">Confirmation d'expédition</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="reviewRequest">
                            <label class="form-check-label" for="reviewRequest">Demande d'avis</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-purple">Enregistrer les modifications</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taxes -->
            <div class="tab-pane fade" id="taxes" role="tabpanel" aria-labelledby="taxes-tab">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Configuration des taxes</h5>
                        <p class="card-text">Configurez les taux de TVA appliqués à vos produits.</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="standardTax" class="form-label">France (TVA standard)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="standardTax" value="20.00" min="0" max="100" step="0.01">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="reducedTax" class="form-label">France (TVA réduite)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="reducedTax" value="5.50" min="0" max="100" step="0.01">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="includeTax" checked>
                            <label class="form-check-label" for="includeTax">Inclure la TVA dans les prix affichés</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-purple">Enregistrer les modifications</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
