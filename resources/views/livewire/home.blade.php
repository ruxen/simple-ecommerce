<div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700">
    <!-- Hero Section -->
    <div class="bg-cover bg-center h-[500px] flex items-center justify-center relative"
        style="background-image: url('https://images.unsplash.com/photo-1527443154391-507e9dc6c5cc');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 px-4 text-center text-white sm:px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold md:text-6xl">Explore the Future of Technology</h1>
            <p class="mb-8 text-lg md:text-xl">Discover the latest in laptops, smartphones, and more.</p>
            <a href="#"
                class="inline-block px-8 py-3 font-semibold text-white transition duration-300 bg-blue-500 rounded-lg shadow-lg hover:bg-blue-600">Shop
                Now</a>
        </div>
    </div>

    <!-- Shop by Brands Section -->
    <section class="py-20 text-gray-900 bg-white">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Title -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold leading-tight">Shop by Popular <span class="text-blue-600">Brands</span>
                </h2>
                <div class="relative flex flex-col items-center">
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 sm:gap-8">
                @foreach ($brands as $brand)
                    <div
                        class="relative p-4 overflow-hidden transition duration-300 ease-in-out bg-gray-100 rounded-lg shadow-lg group hover:bg-gray-200">
                        <a href="{{ route('products') }}?selectedBrands[0]={{ $brand->id }}"
                            class="flex items-center justify-center">
                            <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}"
                                class="object-cover h-32 transition-transform duration-500 ease-in-out sm:h-40 md:h-48 group-hover:scale-110">
                        </a>
                        <div class="p-4 text-center">
                            <a href="#"
                                class="text-lg font-semibold text-gray-800 transition duration-300 hover:text-blue-600">{{ Str::title($brand->name) }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Shop by Categories Section -->
    <section class="py-20 text-gray-900 bg-gray-100">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Title -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold leading-tight">Shop by <span class="text-blue-600">Categories</span></h2>
                <div class="relative flex flex-col items-center">
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('products') }}?selectedCategories[0]={{ $category->id }}"
                        class="flex flex-col items-center p-4 transition-shadow duration-300 ease-in-out bg-white border rounded-lg shadow-md hover:shadow-lg">
                        <img src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}"
                            class="object-cover w-20 h-20 mb-4 transition-transform duration-300 ease-in-out transform group-hover:scale-110">
                        <h3 class="text-lg font-semibold text-gray-800 transition duration-300 hover:text-blue-600">
                            {{ $category->name }}
                        </h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="py-20 text-gray-900 bg-white">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            <!-- Title -->
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold leading-tight">New <span class="text-blue-600">Products</span></h2>
                <div class="relative flex flex-col items-center">
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    <div
                        class="relative overflow-hidden transition duration-300 ease-in-out rounded-lg shadow-lg group">
                        <a href="#">
                            <div class="flex items-center justify-center">
                                <img src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}"
                                    class="object-cover h-32 transition-transform duration-500 ease-in-out sm:h-40 md:h-48 group-hover:scale-90">
                            </div>
                            <div class="text-center">
                                <h3 class="text-sm font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $product->stock }} items available</p>
                                <p class="text-lg font-medium text-gray-900">
                                    {{ Number::currency($product->price, 'IDR') }}
                                </p>
                            </div>
                        </a>
                        <div class="p-4 text-center">
                            <div class="flex justify-center">
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="w-full p-3 rounded-md text-gray-50 {{ $product->stock == 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-600' }}"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to
                                        Cart</span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})"
                                        class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-gray-50 rounded-full dark:text-gray-200"
                                        role="status" aria-label="loading"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</div>
