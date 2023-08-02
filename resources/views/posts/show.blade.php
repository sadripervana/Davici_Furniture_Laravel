
<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <x-add-to-cart-show :posts="$post" :random="$random" :existingLike="$existingLike"/>
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">

            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @include ('posts._add-comment-form')

                @foreach ($post->comments as $comment)
                    <x-post-comment :comment="$comment"/>
                @endforeach

                

            </section>
        </article>
    </main>
</x-layout>
