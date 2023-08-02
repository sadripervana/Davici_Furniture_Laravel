@props(['post'])

<article
    class="transition-colors duration-300 hover:bg-gray-100 border-opacity-0 hover:border-opacity-5  relative category-posts">
    <div class="">
        <a href="/posts/{{ $post->slug }}">
        <div class="">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Blog Post illustration" class="category-image">
        </div>

        
                <div class="absolute category-name">
                    <h4 class="">
                            {{ ucfirst($post->category->name) }}
                    </h4>
                </div>
            </header>

            </a>
    </div>
</article>
