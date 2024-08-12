<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">
        Checkout
    </h1>
    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-12 lg:col-span-7">
                <!-- Card -->
                <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="first_name">
                                    First Name
                                </label>
                                <input wire:model="firstName" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="first_name" type="text">
                                </input>
                                @error('firstName')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="last_name">
                                    Last Name
                                </label>
                                <input wire:model="lastName" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="last_name" type="text">
                                </input>
                                @error('lastName')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block mb-1 text-gray-700 dark:text-white" for="phone">
                                Phone
                            </label>
                            <input wire:model="phone" required
                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                id="phone" type="text">
                            </input>
                            @error('phone')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block mb-1 text-gray-700 dark:text-white" for="address">
                                Address
                            </label>
                            <input wire:model="address" required
                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                id="address" type="text">
                            </input>
                            @error('address')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="district">
                                    District
                                </label>
                                <input wire:model="district" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="district" type="text">
                                </input>
                                @error('district')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="city">
                                    City
                                </label>
                                <input wire:model="city" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="city" type="text">
                                </input>
                                @error('city')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="province">
                                    Province
                                </label>
                                <input wire:model="province" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="province" type="text">
                                </input>
                                @error('province')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1 text-gray-700 dark:text-white" for="zip">
                                    ZIP Code
                                </label>
                                <input wire:model="zipCode" required
                                    class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="zip" type="text">
                                </input>
                                @error('zipCode')
                                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-5">
                <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-slate-900">
                    <div class="mb-2 text-xl font-bold text-gray-700 underline dark:text-white">
                        ORDER SUMMARY
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($items as $item)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="Neil image" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage', $item['image']) }}">
                                        </img>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Quantity: {{ $item['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::currency($item['total_amount'], 'IDR') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-between mt-4 mb-2 font-bold">
                        <span>
                            Subtotal
                        </span>
                        <span>
                            {{ Number::currency($total, 'IDR') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Shipping Cost
                        </span>
                        <span>
                            0.00
                        </span>
                    </div>
                    <hr class="h-1 my-4 rounded bg-slate-400">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Grand Total
                        </span>
                        <span>
                            {{ Number::currency($total, 'IDR') }}
                        </span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                    class="w-full p-3 mt-4 text-lg text-white bg-green-500 rounded-lg hover:bg-green-600">
                    Place Order
                </button>
            </div>
        </div>
    </form>
</div>

@script
    <script>
        $wire.on('snap-token', (event) => {
            snap.pay(event.token, {
                onSuccess: function(result) {
                    $wire.dispatchSelf('payment-status', {
                        status: 'success'
                    });
                },
                onPending: function(result) {
                    $wire.dispatchSelf('payment-status', {
                        status: 'pending'
                    });
                },
                onError: function(result) {
                    $wire.dispatchSelf('payment-status', {
                        status: 'error'
                    });
                }
            });
        });
    </script>
@endscript
