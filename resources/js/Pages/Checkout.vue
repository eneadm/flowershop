<template>
    <web-layout>
        <div class="container mx-auto px-6">
            <template v-if="products">
                <h3 class="text-gray-600 text-2xl font-medium">Checkout:</h3>
                <div class="flex justify-between items-center mt-6 pt-6" v-for="(product, index) in products" :key="index" :class="{ 'border-t' : index > 0 }">
                    <div class="flex items-center">
                        <div class="w-16 h-16 md:w-28 md:h-28">
                            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="product.image">
                        </div>
                        <div class="flex flex-col ml-3">
                            <span class="md:text-md font-medium uppercase">{{ product.title }}</span>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="pr-8">
                            <span class="text-sm font-medium">x {{ product.quantity }} - ${{ formatPrice(product.price) }}</span>
                        </div>
                        <div class="pr-2">
                            <button class="text-red-500" @click="removeProduct(product)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="px-8 py-2 bg-indigo-600 text-white text-md font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500" @click="checkout()">
                        Checkout <strong>${{ formatPrice(this.total()) }}</strong>
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="text-center my-62">
                    <h2 class="font-bold text-lg">No products in the basket.</h2>
                </div>
            </template>
        </div>
    </web-layout>
</template>

<script>
    import WebLayout from '@/Layouts/WebLayout'
    import Button from "@/Jetstream/Button";

    export default {
        props: {
            products: Array,
        },
        components: {
            Button,
            WebLayout,
        },
        methods: {
            formatPrice(amount) {
                return amount / 100
            },

            total() {
                return this.products.map(product => {
                    return product.price * product.quantity
                }).reduce((a, b) => a + b)
            },

            removeProduct(product) {
                this.$inertia.delete(route('basket.destroy', product.id))
            },

            checkout() {
                this.$inertia.post(route('checkout.store'), this.products)
            },
        }
    }
</script>
