<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Product
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <update-product-form class="mt-10 sm:mt-0" :product="product" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import UpdateProductForm from "./UpdateProductForm";

    export default {
        components: {
            AppLayout,
            UpdateProductForm,
        },
        props: {
            product: Object,
        },
    }
</script>
