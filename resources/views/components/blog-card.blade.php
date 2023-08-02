@props(['blog'])

<div class="card text-center" style="width: 25rem; margin:20px">
    <div class="image-card relative ">
        <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="card-img-top blog-image" alt="...">
        <div class="image-date absolute ">
            <span class="day">{{ $blog->created_at->format('d'); }}</span>
            <br>
            <span class="month">{{ $blog->created_at->format('F'); }}</span>
        </div>
    </div>
  <div class="card-body">
    <h6 class="category-color">{{$blog->category->name}}</h6>
    <h3 class="card-title blog-title">{{ substr($blog->title,0,25)}}</h3>
    <div class="flex-container">
        <h6 class="blog-author">By: <span class="blog-author-span">{{ucfirst($blog->author->name)}}</span></h6>
        <h6 class="blog-comments">{{ $blog->comments->count() }} Comments</h6>
    </div>
    
    <p class="card-text blog-body">{{substr($blog->body,0,100)}}</p>
    <div class="flex-container">
    <a href="/blog/{{ $blog->slug }}" class="read-more">Read More <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
        </svg>
    </a>
    </div>

  </div>
</div>
