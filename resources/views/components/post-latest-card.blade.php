@props(['post'])

<article
    class="transition-colors duration-300 hover:bg-gray-100 border-opacity-0 hover:border-opacity-5 post-latest-article ">
    <div class="card m-5 text-black-imp" style="width: 18rem;">
        <a href="/posts/{{ $post->slug }}">
        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <x-rate-yo-visual :post="$post"/>
            <h5 class="card-title">{{ ucfirst($post->title) }}</h5>
            <p class="card-text"> ${{ ucfirst($post->price) }}</p>
        </div>
        </a>
    </div>
</article>
