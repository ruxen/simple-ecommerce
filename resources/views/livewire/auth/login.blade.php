<div class="w-full max-w-md p-6 mx-auto">
    <div class="bg-white border border-gray-200 shadow-sm mt-7 rounded-xl dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Don't have an account yet?
                    <a wire:navigate
                        class="font-medium text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                        href="{{ route('register') }}">
                        Sign up here
                    </a>
                </p>
            </div>

            <hr class="my-5 border-slate-300">

            <!-- Form -->
            <form wire:submit.prevent="login">
                <div class="grid gap-y-4">
                    <!-- Form Group -->
                    <div>
                        <label for="email" class="block mb-2 text-sm dark:text-white">Email address</label>
                        <div class="relative">
                            <input type="email" id="email" wire:model="email"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required aria-describedby="email-error">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block mb-2 text-sm dark:text-white">Password</label>
                            {{-- <a wire:navigate
                                class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                href="{{ route('forgot.password') }}">Forgot password?</a> --}}
                        </div>
                        <div class="relative">
                            <input type="password" id="password" wire:model="password"
                                class="block w-full px-4 py-3 text-sm border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required aria-describedby="password-error">
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                    <button type="submit"
                        class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign
                        in</button>
                </div>
            </form>
            <!-- End Form -->

        </div>
    </div>
</div>
