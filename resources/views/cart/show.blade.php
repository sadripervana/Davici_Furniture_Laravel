<x-layout>
    <x-setting-cart heading="Your Cart">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Title</th>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Color</th>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Size</th>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Quantity</th>
                                <th class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">Price</th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($carts as $cart)
                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                    <a href="/posts/{{ $cart[1]['slug'] }}">
                                                        {{ $cart[1]['title'] }}

                                                        {{-- @php 
                                                        dd($cart[0]['id']);
                                                        @endphp --}}
                                                    </a>
                                                </div>
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                    <a href="/carts/">
                                                        {{ $cart[1][''] }}
                                                    </a>
                                                </div>
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $cart[0]['color'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $cart[0]['size'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $cart[0]['quantity'] }}
                                            </div>
                                        </td>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="text-sm font-medium text-gray-900">
                                                ${{ $cart[1]['price'] * $cart[0]['quantity'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="{{ route('carts.destroy', $cart[0]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-xs text-gray-400" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        <tfoot>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-green-500">
                                ${{$totalPrice}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-green-500 hover:text-blue-600 ">Total</a>
                            </td>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>
