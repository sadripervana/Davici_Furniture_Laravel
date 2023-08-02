<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js" integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Latest compiled and minified Ratio JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link rel="stylesheet" href="/app.css">
<!-- font awesome icons cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />


{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
 {{-- Slick --}}
 <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <!-- Latest compiled and minified Ratio CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
    html {
        scroll-behavior: smooth;
    }

    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line {
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <header id="header" class="shadow">
        <nav class="md:flex md:justify-between md:items-center nav-bar navbar">
            <div>
                <a href="/">
                    <img src="/images/logo.jpg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <!-- toggle button -->
            <button class="toggle-button">

                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse1">
                <ul class="md:flex md:justify-between md:items-center px-3  ">
                    <li><a href="{{ route('home')}}" class="px-3 py-2">Home</a></li>
                    <li><a href="#" class="px-3 py-2">Categories</a></li>
                    <li><a href="{{ route('blog')}}" class="px-3 py-2">Blog</a></li>
                    <li><a href="#" class="px-3 py-2">Vendors</a></li>
                    <li><a href="#" class="px-3 py-2">Page</a></li>
                </ul>  
            </div>
            <div class="space-y-2 lg:space-y-0 lg:space-x-4  md:flex md:justify-between md:items-center collapse1">
                       

                <!-- Search -->
                <div id="search-container" class="relative flex lg:inline-flex items-center bg-white-100 py-1 px-3 search-form collapse1">
                    <form method="GET" action="/" id="search-form">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <input type="text"
                        name="search"
                        placeholder="Search"
                        class="bg-transparent placeholder-black font-semibold text-sm"
                        value="{{ request('search') }}"
                    >
                </form>

                <div class="relative lg:inline-flex flex lg:border-l">
                    <x-category-dropdown />
                    <button form="search-form" type="submit" class="search-form-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>

                </div>
            </div>

            <div class="mt-8 md:mt-0 flex items-center collapse1">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xs font-bold uppercase">
                                Welcome, {{ auth()->user()->name }}!
                            </button>
                        </x-slot>

                        @admin
                            <x-dropdown-item
                                href="/admin/posts"
                                :active="request()->is('admin/posts')"
                            >
                                Dashboard
                            </x-dropdown-item>

                            <x-dropdown-item
                                href="/admin/posts/create"
                                :active="request()->is('admin/posts/create')"
                            >
                                New Post
                            </x-dropdown-item>
                        @endadmin

                        <x-dropdown-item
                            href="/guest/blog/create"
                            :active="request()->is('/guest/blog/create')"
                        >
                            New Blog
                        </x-dropdown-item>
                        <x-dropdown-item
                            href="#"
                            x-data="{}"
                            @click.prevent="document.querySelector('#logout-form').submit()"
                        >
                            Log Out
                        </x-dropdown-item>

                        <form id="logout-form" method="POST" action="/logout" class="hidden">
                            @csrf
                        </form>
                    </x-dropdown>
                @else
                    <a href="/register"
                       class="text-xs font-bold uppercase {{ request()->is('register') ? 'text-blue-500' : '' }}">
                        Register
                    </a>

                    <a href="/login"
                       class="ml-6 text-xs font-bold mr-10 uppercase {{ request()->is('login') ? 'text-blue-500' : '' }}">
                        Log In
                    </a>
                @endauth
            </div>
        </nav>
    </header>
        <section>

        {{ $slot }}
            
        <footer id="footer"
                class="md:flex flex-wrap md:justify-around md:items-center  border border-grey border-opacity-5 py-16 px-10 mt-16"
        >
            <div class="shop">
                <ul>
                    <li><a href="#"><span>Shop</span></a></li>
                    <li><a href="#"> Our Story</li>
                    <li><a href="#">Visit Melbourn Studio</a></li>
                    <li><a href="#">Visit Sydney Studio</a></li>
                    <li><a href="#">Visit Brisban Studio</a></li>
                    <li><a href="#">Desing</a></li>
                    <li><a href="#">How Davici Works</a></li>
                </ul>
            </div>
            <div class="help">
                <ul>
                    <li><a href="#"><span>Help</span></a></li>
                    <li><a href="#">Contact & FAQ</li>
                    <li><a href="#">Track Your Order</a></li>
                    <li><a href="#">Shippinng & Delivery</a></li>
                    <li><a href="#">Visit Brisbane Studio</a></li>
                    <li><a href="#">Interest Free Finance</a></li>
                    <li><a href="#">Cipmoney</a></li>
                </ul>
            </div>
            <div class="service">
                <ul>
                    <li><a href="#"><span>Service</span></a></li>
                    <li><a href="#">Assembly Guides</li>
                    <li><a href="#">Furniture Packages & Fitouts</a></li>
                    <li><a href="#">Trade Program</a></li>
                    <li><a href="#">Sale</a></li>
                    <li><a href="#">New Desings</a></li>
                    <li><a href="#">Gift Cards</a></li>
                </ul>
            </div>
            <div class="contact">
                <ul>
                    <li><a href="#"><span>Contact</span></a></li>
                    <li><a href="#">Twiter</li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instragram</a></li>
                    <li><a href="#">Finterest</a></li>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </footer>

        <div class="underfooter md:flex  md:justify-between  md:items-center  border border-grey border-opacity-5 py-3 px-10">
            <div class=" md:flex">
            <a href="#">&copy 2020 Davici. All Rights Reserved.</a>
            <ul class="md:flex px-10">
                <li class="px-10">Privatcy</li>
                <li class="px-10">Terms</li>
                <li class="px-10">*Promo T&Cs Apply(view here)</li>
            </ul>
            </div>
            
            <img src="/images/underfooter-img.jpg" alt="payment">
        </div>
    </section>

    <x-flash/>
    
        <script src="{{ asset('toggle.js')}}"></script>
        <!-- Add this script to your HTML -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>

    {{-- Jquery  --}}
    {{-- Slick --}}

{{-- bootsrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
