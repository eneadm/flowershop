<template>
    <web-layout>
        <div class="container mx-auto px-6">
            <div class="md:flex md:items-center" v-if="selected !== null">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="products[selected].image">
                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 uppercase text-lg">{{ products[selected].title }}</h3>
                    <span class="text-gray-500 mt-3">${{ formatPrice(products[selected].price) }}</span>
                    <hr class="my-3">
                    <div class="flex items-center mt-6">
                        <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500" @click="addToBasket()">Add to basket</button>
                    </div>
                </div>
            </div>
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Products:</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6" v-if="products.length">
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden cursor-pointer hover:shadow-xl transition-shadow" v-for="(product, index) in products" @click="selected = index">
                        <div class="flex items-end justify-end h-56 w-full bg-cover bg-center" :style="{ 'background-image': `url(${product.image})` }"></div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ product.title }}</h3>
                            <span class="text-gray-500 mt-2">${{ formatPrice(product.price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </web-layout>
</template>

<script>
    import WebLayout from '@/Layouts/WebLayout'

    export default {
        components: {
            WebLayout,
        },
        props: {
            products: Array,
        },
        data: () => {
           return {
               isOpen: false,
               selected: null,
           }
        },
        mounted() {
            if (this.$page.props.flash?.message) {
                this.$swal(this.$page.props.flash.message, '', this.$page.props.flash.type);
            }
        },
        methods: {
            formatPrice(amount) {
                return amount / 100
            },

            addToBasket() {
                if (!this.$page.props.user) {
                    return window.location = route('register')
                }

                this.$inertia.post(route('basket.store'),
                    {...this.products[this.selected], quantity : 1}
                )
            },
        }
    }
</script>
