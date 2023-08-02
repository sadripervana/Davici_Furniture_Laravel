@props(['posts'])

@foreach ($posts as $post)
    
<x-post-latest-card :post="$post"/>
@endforeach

{{-- <x-post-featured-card :post="$posts[12]" />
<x-post-featured-card :post="$posts[6]" />
<x-post-featured-card :post="$posts[11]" />
<x-post-featured-card :post="$posts[9]" /> --}}
