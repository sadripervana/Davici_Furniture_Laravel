@props(['post'])

<div class="rating">
    <div id="rateYo_{{ $post->id }}" ></div>

    <form method="POST" action="{{ route('posts.rate', ['id' => $post->id]) }}">
        @csrf
        <input type="hidden" name="rating" id="ratingInput_{{ $post->id }}">
    </form>
</div>

@if($post->averageRating)

<script>
    $(function () {
        var averageRating = {{ $post->averageRating ?? 0 }};

        $("#rateYo_{{ $post->id }}").rateYo({
            rating: parseFloat(averageRating)
        });
    });
</script>
@endif