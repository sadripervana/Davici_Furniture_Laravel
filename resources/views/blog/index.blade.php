<x-layout>
    <div class="flex blog-posts pt-5 mx-5">
        @if ($blog->count())
            @foreach($blog as $b)
                <x-blog-card :blog="$b" />
            @endforeach
        @endif
        {{ $blog->links() }} <!-- To display pagination links -->
    </div>

</x-layout>
