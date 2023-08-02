@props(['posts'])

@foreach ($posts as $post)
    
<x-post-featured-card :post="$post"/>
@endforeach