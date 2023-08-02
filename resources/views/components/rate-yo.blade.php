@props(['post','averageRating'])

<div class="rating">
    <br>
    <div id="rateYo" ></div>

    <form method="POST" action="{{ route('posts.rate', ['id' => $post->id]) }}">
        @csrf
        <input type="hidden" name="rating" id="ratingInput">
        <button type="submit" class="beautiful-button m-2">Submit Rating</button>
    </form>
</div>

<script>
    $(function () {
        var averageRating = {{ $averageRating ?? 0}};

        $("#rateYo").rateYo({
            rating: parseFloat(averageRating)
        });
    });

    $(function () {
 
    $("#rateYo").rateYo()
        .on("rateyo.change", function (e, data) {

        var rating = data.rating;
        // $(this).next().text(rating);
        $("#ratingInput").val(rating);
        });
    });
</script>