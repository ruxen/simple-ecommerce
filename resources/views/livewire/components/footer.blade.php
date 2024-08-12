<!-- Footer Section -->
<footer class="text-white bg-gray-900">
    <div class="max-w-6xl px-4 py-6 mx-auto sm:px-6 lg:px-8 lg:py-8">
        <div class="flex justify-between">
            <!-- Logo and Description -->
            <div>
                <h2 class="text-2xl font-bold tracking-tight">
                    <span class="text-blue-500">Ruxen</span>Shop
                </h2>
                <p class="mt-4 text-gray-400">
                    Your one-stop shop for all your tech needs.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-2 gap-8 md:grid-cols-3">
                <div>
                    <h3 class="text-lg font-semibold">Shop</h3>
                    <ul class="mt-4 space-y-2">
                        @foreach ($categories as $category)
                            <li><a href="{{ route('products') }}?selectedCategories[0]={{ $category->id }}"
                                    class="text-gray-400 transition duration-300 hover:text-white">{{ $category->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Company</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">About
                                Us</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">Careers</a>
                        </li>
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">Press</a>
                        </li>
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">Blog</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Support</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">Contact
                                Us</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">FAQs</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 transition duration-300 hover:text-white">Shipping</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-300 hover:text-white">Returns</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="pt-6 mt-6 border-t border-gray-700">
            <p class="text-sm text-center text-gray-400">
                &copy; 2024 RuxenShop. All rights reserved.
            </p>
        </div>
    </div>
</footer>
