<x-layout :totalcart="$totalcart">
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
            <x-add-to-cart :posts="$posts" :random="$random"/>

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
