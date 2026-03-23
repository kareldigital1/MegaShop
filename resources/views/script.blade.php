<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/main/user/user.js') }}"></script>
<script>
    new Swiper('.featured-products', {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('promo-code');
        const button = document.getElementById('apply-button');

        input.addEventListener('input', function() {
            if (input.value.trim() !== '') {
                button.style.backgroundColor = '#8d46c0'; // Couleur plus foncée
            } else {
                button.style.backgroundColor = '#d6b3f9'; // Couleur initiale
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if (isset($monthlyRevenueLabels) && isset($monthlyRevenueData))
    <script>
        const revenueCtx = document.getElementById('revenue-chart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyRevenueLabels),
                datasets: [{
                    label: 'Revenus',
                    data: @json($monthlyRevenueData),
                    backgroundColor: 'rgba(124, 58, 237, 0.5)',
                    borderColor: 'rgba(124, 58, 237, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endif

@if (isset($weeklyOrdersLabels) && isset($weeklyOrdersData))
    <script>
        const ordersCtx = document.getElementById('orders-chart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: @json($weeklyOrdersLabels), // Ex: ['Lun', 'Mar', 'Mer', ...]
                datasets: [{
                    label: 'Commandes',
                    data: @json($weeklyOrdersData), // Ex: [15, 22, 18, ...]
                    borderColor: 'rgba(124, 58, 237, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endif

@if (isset($categoryLabels) && isset($categoryData))
    <script>
        const categoryCtx = document.getElementById('category-chart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: @json($categoryLabels), // Ex: ['Électronique', 'Vêtements', ...]
                datasets: [{
                    data: @json($categoryData), // Ex: [35, 25, 20, ...]
                    backgroundColor: ['#7C3AED', '#8B5CF6', '#A78BFA', '#C4B5FD', '#DDD6FE'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}%`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchQueryInput = document.getElementById('searchQuery');
        const customersTable = document.getElementById('customersTable');

        searchQueryInput.addEventListener('input', function() {
            const query = searchQueryInput.value.toLowerCase();
            const rows = customersTable.querySelectorAll('tr');

            rows.forEach(row => {
                const name = row.querySelector('td:first-child').innerText.toLowerCase();
                const email = row.querySelector('td:first-child p.text-muted').innerText
                    .toLowerCase();

                if (name.includes(query) || email.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    function viewCustomerDetails(customerId) {
        // Fetch customer details via AJAX or load dynamically
        const modalContent = document.getElementById('customerDetailsContent');
        modalContent.innerHTML = `<p>Chargement des détails pour le client #${customerId}...</p>`;
        const modal = new bootstrap.Modal(document.getElementById('customerDetailsModal'));
        modal.show();

        // Simulate fetching data
        setTimeout(() => {
            modalContent.innerHTML = `
                <p><strong>Nom :</strong> Client ${customerId}</p>
                <p><strong>Email :</strong> client${customerId}@example.com</p>
                <p><strong>Téléphone :</strong> 06 12 34 56 78</p>
            `;
        }, 1000);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('addEditProductModal');
        const productForm = document.getElementById('productForm');

        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Bouton qui a déclenché le modal
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productSlug = button.getAttribute('data-slug');
            const productShortDescription = button.getAttribute('data-short-description');
            const productDescription = button.getAttribute('data-description');
            const productPrice = button.getAttribute('data-price');
            const productOldPrice = button.getAttribute('data-old-price');
            const productCostPrice = button.getAttribute('data-cost-price');
            const productStock = button.getAttribute('data-stock');
            const productSku = button.getAttribute('data-sku');
            const productCategoryId = button.getAttribute('data-category-id');
            const productIsFeatured = button.getAttribute('data-is-featured') === 'true';
            const productIsNew = button.getAttribute('data-is-new') === 'true';
            const productIsSale = button.getAttribute('data-is-sale') === 'true';
            const productImage = button.getAttribute('data-image');

            // Si un produit est sélectionné, pré-remplir le formulaire
            if (productId) {
                productForm.action =
                `/admin/products/${productId}`; // Met à jour l'action du formulaire
                productForm.querySelector('[name="_method"]').value = 'PUT'; // Ajoute la méthode PUT
                productForm.querySelector('#productName').value = productName;
                productForm.querySelector('#productSlug').value = productSlug;
                productForm.querySelector('#productShortDescription').value = productShortDescription;
                productForm.querySelector('#productDescription').value = productDescription;
                productForm.querySelector('#productPrice').value = productPrice;
                productForm.querySelector('#productOldPrice').value = productOldPrice;
                productForm.querySelector('#productCostPrice').value = productCostPrice;
                productForm.querySelector('#productStock').value = productStock;
                productForm.querySelector('#productSku').value = productSku;
                productForm.querySelector('#productCategory').value = productCategoryId;
                productForm.querySelector('#isFeatured').checked = productIsFeatured;
                productForm.querySelector('#isNew').checked = productIsNew;
                productForm.querySelector('#isSale').checked = productIsSale;
            } else {
                // Si aucun produit n'est sélectionné, réinitialiser le formulaire
                productForm.action = "{{ route('admin.products.store') }}";
                productForm.querySelector('[name="_method"]').value = 'POST';
                productForm.reset();

                // Réinitialiser les cases à cocher
                productForm.querySelector('#isFeatured').checked = false;
                productForm.querySelector('#isNew').checked = false;
                productForm.querySelector('#isSale').checked = false;
            }

            if (productImage) {
                imagePreview.innerHTML = `<img src="/storage/${productImage}" alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">`;
            } else {
                imagePreview.innerHTML = '';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchQueryInput = document.getElementById('searchQuery');
        const statusFilter = document.getElementById('statusFilter');
        const paymentFilter = document.getElementById('paymentFilter');
        const ordersTable = document.getElementById('ordersTable');

        // Filtrer les commandes
        function filterOrders() {
            const query = searchQueryInput.value.toLowerCase();
            const status = statusFilter.value;
            const payment = paymentFilter.value;

            Array.from(ordersTable.querySelectorAll('tr')).forEach(row => {
                const customerName = row.children[1].innerText.toLowerCase();
                const orderStatus = row.children[3].innerText.toLowerCase();
                const paymentStatus = row.children[4].innerText.toLowerCase();

                const matchesQuery = customerName.includes(query) || row.children[0].innerText.includes(
                    query);
                const matchesStatus = status === 'all-status' || orderStatus.includes(status);
                const matchesPayment = payment === 'all-payment' || paymentStatus.includes(payment);

                row.style.display = matchesQuery && matchesStatus && matchesPayment ? '' : 'none';
            });
        }

        searchQueryInput.addEventListener('input', filterOrders);
        statusFilter.addEventListener('change', filterOrders);
        paymentFilter.addEventListener('change', filterOrders);

        // Charger les détails de la commande
        window.viewOrderDetails = function(orderId) {
            const modalContent = document.getElementById('orderDetailsContent');
            modalContent.innerHTML = `<p>Chargement des détails pour la commande #${orderId}...</p>`;
            const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            modal.show();

            // Simuler une requête AJAX pour charger les détails
            setTimeout(() => {
                modalContent.innerHTML = `
                    <p><strong>Commande :</strong> #${orderId}</p>
                    <p><strong>Client :</strong> Michel Dupont</p>
                    <p><strong>Date :</strong> 06/04/2024</p>
                    <p><strong>Total :</strong> 249.99 €</p>
                    <p><strong>Statut :</strong> En traitement</p>
                    <p><strong>Paiement :</strong> Payé</p>
                `;
            }, 1000);
        };
    });
</script>
