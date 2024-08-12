<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container px-4 mx-auto">
        <h1 class="mb-4 text-2xl font-semibold">Shopping Cart</h1>
        <div class="flex flex-col gap-4 md:flex-row">
            <div class="md:w-3/4">
                <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="font-semibold text-left">Product</th>
                                <th class="font-semibold text-left">Price</th>
                                <th class="font-semibold text-left">Quantity</th>
                                <th class="font-semibold text-left">Total</th>
                                <th class="font-semibold text-left">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="w-16 h-16 mr-4" src="{{ url('storage', $item['image']) }}"
                                                alt="{{ $item['name'] }}">
                                            <div class="flex flex-col">
                                                <span class="font-semibold">{{ $item['name'] }}</span>
                                                <p class="text-sm text-gray-500">Stock:
                                                    {{ $productStocks[$item['product_id']] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($item['price'], 'IDR') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                                class="px-4 py-2 mr-2 border rounded-md">-</button>
                                            <span class="w-8 text-center">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"
                                                class="px-4 py-2 ml-2 border rounded-md">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($item['total_amount'], 'IDR') }}</td>
                                    <td>
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="w-[90px] px-3 py-2 text-sm font-semibold text-gray-100 transition-colors duration-300 bg-red-500 rounded-lg hover:bg-red-700 hover:text-white">
                                            <span wire:loading.remove
                                                wire:target="removeItem({{ $item['product_id'] }})">
                                                Remove
                                            </span>
                                            <span wire:loading wire:target="removeItem({{ $item['product_id'] }})"
                                                class="animate-spin inline-block h-4 w-4 border-[3px] border-current border-t-transparent text-gray-50 rounded-full dark:text-gray-200"
                                                role="status" aria-label="loading">
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center">
                                        <div class="text-lg font-semibold text-gray-500">
                                            Your cart is currently empty.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-lg font-semibold">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($total, 'IDR') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping</span>
                        <span>$0.00</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">{{ Number::currency($total, 'IDR') }}</span>
                    </div>
                    @if ($items)
                        <button wire:click="redirectToCheckout"
                            class="w-full px-4 py-2 mt-4 text-gray-100 bg-blue-500 rounded-lg hover:text-white hover:bg-blue-600 {{ !$canCheckout ? 'opacity-50 cursor-not-allowed' : '' }}"
                            @if (!$canCheckout) disabled @endif>
                            Checkout
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
