@props(['posts', 'random', 'existingLike'])

<div class="add-to-card" id="add-to-card">
    <div class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        @isset($posts[$random]) 
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
                    <div class="post-title-link">
                       <a href="/posts/{{$posts[$random]->slug}}" >
                        {{ $posts[$random]->title }}
                    </a>
                    </div>
                </h1>
                <h4 class="price-text">${{$posts[$random]->price}}</h4>

                <div class="space-x-2 my-3 category-cart">
                    <x-category-button :category="$posts[$random]->category"/>
                </div>

                <div class="space-y-4 lg:text-lg leading-loose cart-body">{!! $posts[$random]->body !!}</div>
                
                <form action="{{ route('add.to.cart')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" value="{{ $posts[$random]->id }}">
                    <div class="flex aling-center">
                        <h4 class="mr-3">Color</h4>
                        <div class="color-options my-3">
                            
                            @foreach (explode(',', $posts[$random]->color) as $color)
                                <div class="color-option text-center aling-center" style="background-color: {{ $color }};" id="colorOptionsElement">
                                    <input type="radio" name="color" id="{{$color}}" value="{{$color}}" required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex aling-center">
                        <h4 class="mr-3">Size</h4>
                        <div class="size-options">
                            
                            @foreach (explode(',', $posts[$random]->size) as $size)
                                <div class="size-option" >{{ $size }}
                                    <input type="radio" name="size" id="{{$size}}" value="{{$size}}" required>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="add-to-cart my-3">
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
                    
                    <script>
                        function likes() {
                            var postId = {{ $posts[$random]->id }}; // Assuming $posts is the current post object in the view
                            
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

                                    // // Clear existing color options (if any)
                                    colorOptionsElement.innerHTML = '';

                                    // Add the new color options
                                    if (data.post['data'][random].color) {

                                        // Convert the string of colors from data.post['data'][random].color into an array
                                        const colors = data.post['data'][random].color.split(',');

                                        // Loop through the colors array and dynamically generate the color options
                                        colors.forEach(color => {
                                            const colorOptionElement = document.createElement('div');
                                            colorOptionElement.classList.add('color-option');
                                            colorOptionElement.style.backgroundColor = color.trim(); // Assuming the color values don't have spaces

                                            // Create the input element and set its attributes
                                            const inputElement = document.createElement('input');
                                            inputElement.type = 'radio';
                                            inputElement.name = 'color';
                                            inputElement.id = color.trim(); // Use the same ID as the color value
                                            inputElement.value = color.trim(); // Use the same value as the color value
                                            inputElement.required = true;
                                            // Append the input element to the colorOptionElement div
                                            colorOptionElement.appendChild(inputElement);

                                            // Append the colorOptionElement div to the colorOptionsElement div
                                            colorOptionsElement.appendChild(colorOptionElement);
                                        });
                                    }

                                    // Assuming you have an element with class "size-option-list" to represent the size options container
                                    const sizeOptionList = document.querySelector('.size-options');

                                    // Clear existing size options (if any)
                                    sizeOptionList.innerHTML = '';

                                    // Add the new size options
                                    if (data.post['data'][random].size) {
                                        // const sizeOptionList = document.getElementById('sizeOptionList');

                                        // Convert the string of sizes from data.post['data'][random].size into an array
                                        const sizes = data.post['data'][random].size.split(',');

                                        sizes.forEach(size => {
                                            // Create a container div to hold the radio button and size option element
                                            const sizeOptionContainer = document.createElement('div');
                                            sizeOptionContainer.classList.add('size-option');

                                            // Create the input element (radio button) and set its attributes
                                            const inputElement = document.createElement('input');
                                            inputElement.type = 'radio';
                                            inputElement.name = 'size';
                                            inputElement.id = size.trim(); // Use the same ID as the size value
                                            inputElement.value = size.trim(); // Use the same value as the size value
                                            inputElement.required = true;
                                            // Create the size option element and set its text content
                                            const sizeOptionElement = document.createElement('div');
                                            sizeOptionElement.textContent = size.trim(); // Assuming the size values don't have spaces

                                            // Append the input element (radio button) to the container div
                                            sizeOptionContainer.appendChild(inputElement);

                                            // Append the size option element to the container div
                                            sizeOptionContainer.appendChild(sizeOptionElement);

                                            // Append the container div (with the radio button and size option element) to the sizeOptionList div
                                            sizeOptionList.appendChild(sizeOptionContainer);
                                        });
                                    }

                                    // Assuming you have an element with class "title-text" to display the title
                                    const titleElement = document.querySelector('.title-text');
                                    const bodyElement = document.querySelector('.cart-body');
                                    const categoryElement = document.querySelector('.category-cart');

                                    // Update the title with the new post's title
                                    titleElement.innerHTML = ''; // Clear the container
                                    const anchorTag = document.createElement('a');
                                    anchorTag.href = '/posts/' + data.post['data'][random].slug;
                                    anchorTag.textContent = data.post['data'][random].title;
                                    titleElement.appendChild(anchorTag);

                                    categoryElement.innerHTML = data.post['data'][random].category.name;
                                    bodyElement.innerHTML = data.post['data'][random].body;

                                    const heartIconPlaceholder = document.getElementById('heartIconPlaceholder');

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
        @endisset
    </div>
</div>