<x-layout>
    <x-setting-cart heading="Your Likes">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @if(count($likes))
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Title</th>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Price</th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                
                                @foreach ($likes as $likes)
                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                    <a href="/posts/{{ $likes[1]['slug'] }}">
                                                        {{ $likes[1]['title'] }}
                                                    </a>
                                                </div>
                                        </td>
                                       
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                ${{ $likes[1]['price'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="{{ route('likes.destroy', $likes[0]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-xs text-gray-400" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        <tfoot>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-green-500" colspan="2">
                                    ${{$totalPrice}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-green-500">
                                    Total
                                </td> 
                            </tr>
                        </tfoot>
                        </table>
                        @else 
                        Your likes is Empty
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>
