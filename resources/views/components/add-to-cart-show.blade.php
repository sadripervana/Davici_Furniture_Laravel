@props(['posts', 'random', 'existingLike'])

<div class="add-to-card" id="add-to-card">
    <div class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-6 lg:text-center lg:pt-14 mb-10">
                <img src="{{ asset('storage/' . $posts->thumbnail) }}" alt="" class="rounded-xl">
            </div>

            <div class="col-span-6">
                <div class="hidden lg:flex justify-between mb-6">
                    <p class="mt-4 block text-gray-400 text-xs">
                        Published
                        <time>{{ $posts->created_at->diffForHumans() }}</time>
                    </p>
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10 title-text">
                    <a href="/posts/{{$posts->slug}}">
                        {{ $posts->title }}
                    </a>
                </h1>
                <h4 class="price-text">${{$posts->price}}</h4>

                <div class="space-x-2 my-3 category-cart">
                    <x-category-button :category="$posts->category"/>
                </div>

                <div class="space-y-4 lg:text-lg leading-loose cart-body">{!! $posts->body !!}</div>
                
                <form action="{{ route('add.to.cart')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" value="{{ $posts->id }}">
                    <div class="flex aling-center">
                        <h4 class="mr-3">Color</h4>
                        <div class="color-options my-3">
                            
                            @foreach (explode(',', $posts->color) as $color)
                                <div class="color-option text-center aling-center" style="background-color: {{ $color }};" id="colorOptionsElement">
                                    <input type="radio" name="color" id="{{$color}}" value="{{$color}}" required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex aling-center">
                        <h4 class="mr-3">Size</h4>
                        <div class="size-options">
                            
                            @foreach (explode(',', $posts->size) as $size)
                                <div class="size-option" >{{ $size }}
                                    <input type="radio" name="size" id="{{$size}}" value="{{$size}}" required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="add-to-cart my-3">
                        @auth
                        <div class="quantity">
                            <div id="numberDisplay" class="number">
                                1
                            </div>
                            <input type="hidden" name="quantity" value="1" id="quantity">
                                
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
                            <button>
                                ADD TO CART
                            </button>
                        </div>
                    </form>
                        <div class="heart" onclick="likes()" id="heartIcon">
                            @if(!$existingLike)
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                            @else 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>
                            @endif
                        </div>
                        <script>
                        function likes() {
                            var postId = {{ $posts->id }}; // Assuming $posts is the current post object in the view
                            
                            $.ajax({
                                url: '{{ route('likes.web', ['id' => '__post_id__']) }}'.replace('__post_id__', postId),
                                type: 'GET', // Make sure the request method is set to GET
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);

                                    // Check if the response indicates the post is unliked
                                    if (data.likes === 0) {
                                        // Update the heart icon to the empty heart SVG
                                        $('#heartIcon').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg>');
                                    } else {
                                        // Update the heart icon to the filled heart SVG
                                        $('#heartIcon').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>');
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.error('Error:', textStatus, errorThrown);

                                    // Additional error information from the xhr object
                                    console.log('Status Code:', xhr.status);
                                    console.log('Response Text:', xhr.responseText);
                                }
                            });
                        }
                        </script>
                    @endauth
                </div>
            </div>
        </article>
    </div>
</div>