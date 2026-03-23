<div class="bg-white border-end border-gray-200 w-64 flex-shrink-0 vh-100 sticky-top d-flex flex-column">
    <div class="px-3 py-4 flex-grow-1 overflow-auto">
        <span class="text-uppercase text-muted small fw-semibold">Administration</span>
        <nav class="mt-3">
            @php
                $navigation = [
                    ['name' => 'Dashboard', 'path' => route('app_dashboard'), 'icon' => 'fa-chart-line'],
                    ['name' => 'Commandes', 'path' => route('admin.orders'), 'icon' => 'fa-shopping-bag'],
                    ['name' => 'Produits', 'path' => route('admin.products'), 'icon' => 'fa-box'],
                    ['name' => 'Clients', 'path' => route('admin.customers'), 'icon' => 'fa-users'],
                    ['name' => 'Transactions', 'path' => route('admin.transactions'), 'icon' => 'fa-credit-card'],
                    ['name' => 'Messages', 'path' => route('admin.messages'), 'icon' => 'fa-envelope'],
                    ['name' => 'Statistiques', 'path' => route('admin.analytics'), 'icon' => 'fa-chart-bar'],
                    ['name' => 'Paramètres', 'path' => route('admin.settings'), 'icon' => 'fa-cog'],
                ];
            @endphp

            @foreach ($navigation as $item)
                <a href="{{ $item['path'] }}"
                    class="d-flex align-items-center px-3 py-2 rounded text-decoration-none {{ request()->is(ltrim(parse_url($item['path'], PHP_URL_PATH), '/')) ? 'bg-purple text-white' : 'text-dark' }}">
                    <i
                        class="fa {{ $item['icon'] }} me-2 {{ request()->is(ltrim(parse_url($item['path'], PHP_URL_PATH), '/')) ? 'text-white' : 'text-muted' }}"></i>
                    {{ $item['name'] }}
                </a>
            @endforeach
        </nav>
    </div>
</div>
