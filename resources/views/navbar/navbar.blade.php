<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- Logo aligné complètement à gauche et en violet --}}
        <a class="navbar-brand fs-3 fw-bold " style="color: #8d46c0; margin-right:100px" href="{{ route('app_home') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" style="margin-right:200px" role="search">
                <input type="text" class="form-control w-100" id="searchInput" placeholder="Rechercher un produit...">
                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            </form>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold" style="margin-right:100px; font-size:16px">
                <li class="nav-item">
                    <a class="nav-link @if (Request::route()->getName() == 'app_home') active @endif" aria-current="page"
                        href="{{ route('app_home') }}">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::route()->getName() == 'app_about') active @endif"
                        href="{{ route('products.index') }}">Tous les produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::route()->getName() == 'app_dashboard') active @endif"
                        href="{{ route('app_dashboard') }}">Tableau de bord</a>
                </li>
            </ul>

            <div class="btn-group">
                @guest
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    </ul>
                @endguest

                @auth
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('app_logout') }}">
                                    <i class="fa-solid fa-arrow-right-from-bracket">Logout</i>
                                </a>
                            </li>
                    </ul>
                @endauth

                <a href="{{route('cart.index')}}" class="btn btn-light">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
</nav>


