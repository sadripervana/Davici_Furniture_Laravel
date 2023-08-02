<x-layout>
    @if(isset($_GET['category']) || isset($_GET['search']))
        @if ($posts->count())
        <div class="posts-category">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
        @endif
    @else
        @include ('posts._header')

        <main class=" mb-6 mx-auto mt-6 lg:mt-20 space-y-6">

            <div class="shop-by-cat px-6">
                <div class="shop-by-cat-details">
                    <h2 class="mb-5">Shop by Categories</h2>
                    <div class="icon-count flex">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-armchair-2" width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M5 10v-4a3 3 0 0 1 3 -3h8a3 3 0 0 1 3 3v4" /> <path d="M16 15v-2a3 3 0 1 1 3 3v3h-14v-3a3 3 0 1 1 3 -3v2" /> <path d="M8 12h8" /> <path d="M7 19v2" /> <path d="M17 19v2" /> </svg>
                    </span>
                    <div class="text-grey mb-3">
                        {{$totalPosts}} +
                        <br> Unique products
                    </div>
                </div>

                <x-category-dropdown />

                </div>
                
                <div class="slider " style="width: 1700px;">
                    @if ($posts->count())
                        <x-posts-grid :posts="$posts" />
                    @else
                        <p class="text-center">No posts yet. Please check back later.</p>
                    @endif
                </div>
    
            </div>

            <div class="rooms px-6  flex">
                <div class="living-room mr-3 relative">
                    <img src="images/living-room.jpg" alt="" >
                    <div class="inside-living absolute">
                        <h3>30% OFF ALL ORDER</h3>
                        <h1>LIVING ROOM</h1>
                        <button class="shop-now-rounded">Shop Now</button>
                    </div>
                </div>
                <div class="dining-room ml-3 relative">
                    <img src="images/dining-room.jpg" alt="" >
                    <div class="inside-dining absolute">
                        <h3>30% OFF ALL ORDER</h3>
                        <h1>DINING ROOM</h1>
                        <button class="shop-now-rounded">Shop Now</button>
                    </div>
                </div>
            </div>

            <div class="hot-products px-6" id="hot-products">
                <div class="mini-nav space-y-2 lg:space-y-0 lg:space-x-4  md:flex md:justify-between md:items-center">
                    <h3>Hot Product</h3>
                    <ul class="space-y-2 lg:space-y-0 lg:space-x-7  md:flex md:justify-between md:items-center">
                        <li>
                            <a href="?hot=latest#hot-products" class="{{ (isset($_GET['hot']) && $_GET['hot'] === 'latest') ? 'active-link' : 'passive-link' }}">LATEST PRODUCTS</a>
                        </li>                      
                        <li><a href="?hot=top#hot-products" class="{{ (isset($_GET['hot']) && $_GET['hot'] === 'top') ? 'active-link' : 'passive-link' }}">TOP RATING</a></li>
                        <li><a href="?hot=best#hot-products" class="{{ (isset($_GET['hot']) && $_GET['hot'] === 'best') ? 'active-link' : 'passive-link' }}">BEST SELLERS</a></li>
                    </ul>
                    <button class=" px-4 py-2 mt-4 flex items-center all-product-btn">
                        <span class="mr-2">All products</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg></button>
                </div>

                <div class="hot-product-cart flex flex-wrap  md:justify-between md:items-center">
                    @if ($posts->count())
                        <x-posts-latest :posts="$posts"/>
                    @else
                        <p class="text-center">No posts yet. Please check back later.</p>
                    @endif
                </div>    
            </div>

            <div class="good-vibes mt-2">
                <img src="images/good-vibes.jpg" alt="">
            </div>

            <div class="add-to-card" id="add-to-card">
                <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
                    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                        <div class="col-span-6 lg:text-center lg:pt-14 mb-10">
                            <img src="{{ asset('storage/' . $posts[$random]->thumbnail) }}" alt="" class="rounded-xl">
                        </div>

                        <div class="col-span-6">
                            <div class="hidden lg:flex justify-between mb-6">
                                <p class="mt-4 block text-gray-400 text-xs">
                                    Published
                                    <time>{{ $posts[$random]->created_at->diffForHumans() }}</time>
                                </p>
                            </div>

                            <h1 class="font-bold text-3xl lg:text-4xl mb-10 title-text">
                                {{ $posts[$random]->title }}
                            </h1>
                            <h4 class="price-text">${{$posts[$random]->price}}</h4>

                            <div class="space-x-2 my-3 category-cart">
                                <x-category-button :category="$posts[$random]->category"/>
                            </div>

                            <div class="space-y-4 lg:text-lg leading-loose cart-body">{!! $posts[$random]->body !!}</div>
                            
                            <div class="flex aling-center">
                                <h4 class="mr-3">Color</h4>
                                <div class="color-options my-3">
                                    
                                    @foreach (explode(',', $posts[$random]->color) as $color)
                                        <div class="color-option" style="background-color: {{ $color }};"></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex aling-center">
                                <h4 class="mr-3">Size</h4>
                                <div class="size-options">
                                    
                                    @foreach (explode(',', $posts[$random]->size) as $size)
                                        <div class="size-option" >{{ $size }}</div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="add-to-cart my-3">
                                <div class="quantity">
                                    <div id="numberDisplay" class="number">1</div>
                                        
                                    <div class="plus-minus">
                                        <div id="incrementButton" class="plus">
                                           +
                                        </div>
                                        <div class="minus" id="decrementButton">
                                            -
                                        </div>
                                    </div>
                                </div>
                                <div class="add-to-cart-btn ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    ADD TO CART
                                    
                                </div>
                                <div class="heart">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                </div>
                                <div class="shuffle" onclick="shuffleRandom()" id="shuffleDiv">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z"/>
                                        </svg>
                                </div>
                            </div>
                                       
                            <script>
                                let random = {{ $random }};

                                function shuffleRandom() {
                                    $.ajax({
                                        url: '{{ route('get.random') }}',
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(data) {
                                            let newRandom = data.random;
                                            while (newRandom === random) {
                                                newRandom = Math.floor(Math.random() * data.post['data'].length);
                                            }
                                            random = newRandom; // Update the client-side 'random' variable with the new value

                                            if (data.post) {
                                                // Update the image with the new post's thumbnail
                                                const image = document.querySelector('.col-span-6 img');
                                                image.src = '{{ asset('storage/') }}' + '/' + data.post['data'][random].thumbnail;

                                                // Update the price with the new post's price
                                                const priceElement = document.querySelector('.price-text');
                                                priceElement.textContent = '$' + data.post['data'][random].price;

                                                // Assuming you have a parent element with class "color-options" and each color option has class "color-option"
                                                const colorOptionsElement = document.querySelector('.color-options');

                                                // Clear existing color options (if any)
                                                colorOptionsElement.innerHTML = '';

                                                // Add the new color options
                                                if (data.post['data'][random].color) {
                                                    data.post['data'][random].color.split(',').forEach(color => {
                                                        const colorOptionElement = document.createElement('div');
                                                        colorOptionElement.classList.add('color-option');
                                                        colorOptionElement.style.backgroundColor = color.trim(); // Assuming the color values don't have spaces
                                                        colorOptionsElement.appendChild(colorOptionElement);
                                                    });
                                                }

                                                // Assuming you have an element with class "size-option-list" to represent the size options container
                                                const sizeOptionList = document.querySelector('.size-options');

                                                // Clear existing size options (if any)
                                                sizeOptionList.innerHTML = '';

                                                // Add the new size options
                                                if (data.post['data'][random].size) {
                                                    data.post['data'][random].size.split(',').forEach(size => {
                                                        const sizeOptionElement = document.createElement('div');
                                                        sizeOptionElement.classList.add('size-option');
                                                        sizeOptionElement.textContent = size.trim(); // Assuming the size values don't have spaces
                                                        sizeOptionList.appendChild(sizeOptionElement);
                                                    });
                                                }

                                                // Assuming you have an element with class "title-text" to display the title
                                                const titleElement = document.querySelector('.title-text');
                                                const bodyElement = document.querySelector('.cart-body');
                                                const categoryElement = document.querySelector('.category-cart');

                                                // Update the title with the new post's title
                                                titleElement.innerHTML = data.post['data'][random].title;
                                                categoryElement.innerHTML = data.post['data'][random].category.name;
                                                bodyElement.innerHTML = data.post['data'][random].body;
                                                // Update other elements as needed, e.g., title, price, color, size, etc.
                                            } else {
                                                console.error('Error: The server response does not contain the post data.');
                                            }
                                        },
                                        error: function(xhr, textStatus, errorThrown) {
                                            console.error('Error:', errorThrown);
                                        }
                                    });
                                }

                            </script>
                        </div>
                    </article>
                </main>
            </div>

            <div class="we-design mt-20 lg:mt-20 mb-20 ">
                <div class="we-design-img relative">
                    <img src="images/we-desing.jpg" alt="">
                    <div class="we-design-text absolute">
                   <h1>We design everything we make.</h1>
                </div>
                </div>
            </div>

            <div class="cards px-6 mt-20">
                <div class="shipping">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    <h5>Free shipping</h5>
                    <h6>Capped at $39 per order</h6>
                </div>
                <div class="security">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                    </svg>
                    <h5>Securety Payments</h5>
                    <h6>Up to 12 months installments</h6>
                </div>
                <div class="return">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                    </svg>
                    <h5>14-Day Returns</h5>
                    <h6>Shop With confidence</h6>
                </div>
                <div class="fabric">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-through-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.854 15.854A.5.5 0 0 1 2 15.5V14H.5a.5.5 0 0 1-.354-.854l1.5-1.5A.5.5 0 0 1 2 11.5h1.793l.53-.53c-.771-.802-1.328-1.58-1.704-2.32-.798-1.575-.775-2.996-.213-4.092C3.426 2.565 6.18 1.809 8 3.233c1.25-.98 2.944-.928 4.212-.152L13.292 2 12.147.854A.5.5 0 0 1 12.5 0h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.854.354L14 2.707l-1.006 1.006c.236.248.44.531.6.845.562 1.096.585 2.517-.213 4.092-.793 1.563-2.395 3.288-5.105 5.08L8 13.912l-.276-.182a21.86 21.86 0 0 1-2.685-2.062l-.539.54V14a.5.5 0 0 1-.146.354l-1.5 1.5Zm2.893-4.894A20.419 20.419 0 0 0 8 12.71c2.456-1.666 3.827-3.207 4.489-4.512.679-1.34.607-2.42.215-3.185-.817-1.595-3.087-2.054-4.346-.761L8 4.62l-.358-.368c-1.259-1.293-3.53-.834-4.346.761-.392.766-.464 1.845.215 3.185.323.636.815 1.33 1.519 2.065l1.866-1.867a.5.5 0 1 1 .708.708L5.747 10.96Z"/>
                    </svg>
                    <h5>Free Fabric Swatches</h5>
                    <h6>Delivered to your door</h6>
                </div>
            </div>

            <hr>

            <div class="blog text-center">
                <h1>From Our Blog</h1>
                <h6 class="blog-desc">See how our customers have styled davici products in their home</h6>

                <div class="slider2 " style="margin:20px">
                    @if ($blog->count())
                        @foreach($blog as $b)
                            <x-blog-card :blog="$b" />
                        @endforeach
                    @endif
                </div>
            </div>
        </main>
    @endif
    @include ('posts._subscribe')
</x-layout>
