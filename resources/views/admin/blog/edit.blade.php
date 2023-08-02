<x-layout>
    <x-setting :heading="'Edit Blog: ' . $blog->title">
        <form method="POST" action="/admin/blog/{{ $blog->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $blog->title)" required />
            <x-form.input name="slug" :value="old('slug', $blog->slug)" required />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $blog->thumbnail)" />
                </div>

                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            {{-- <x-form.input name="price" :value="old('price', $blog->price)" required /> --}}
            <x-form.textarea name="body" required>{{ old('body', $blog->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category"/>

                <select name="category_id" id="category_id" required>
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category"/>
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
