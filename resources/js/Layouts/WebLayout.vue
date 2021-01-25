<template>
    <div class="bg-white">
        <header>
            <div class="container mx-auto px-6 py-3">
                <div class="flex items-center justify-between">
                    <div class="w-full text-gray-600 md:flex md:items-center">
                        <template v-if="$page.props.user">
                            <button @click="logout" class="text-sm text-gray-700 underline">
                                Logout
                            </button>
                        </template>
                        <template v-else>
                            <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                                Login
                            </inertia-link>

                            <inertia-link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                                Register
                            </inertia-link>
                        </template>

                    </div>
                    <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                        Flowershop
                    </div>
                    <div class="flex items-center justify-end w-full">
                        <a class="text-gray-600 focus:outline-none mx-4 sm:mx-0" :href="route('checkout.index')">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </a>

                        <div class="flex sm:hidden">
                            <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                    <div class="flex flex-col sm:flex-row">
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" :href="route('homepage')">Home</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Shop</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                        <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
                    </div>
                </nav>
            </div>
        </header>

        <main class="my-8">
            <jet-banner />
            <slot></slot>
        </main>
    </div>
</template>

<script>
    import JetBanner from '@/Jetstream/Banner'

    export default {
        components: {
            JetBanner,
        },
        data: () => {
            return {
                isOpen: false,
            }
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        },
    }
</script>
