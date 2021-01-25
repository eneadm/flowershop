<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Order
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <update-order-form class="mt-10 sm:mt-0" :order="order" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import UpdateOrderForm from "./UpdateOrderForm";

    export default {
        components: {
            AppLayout,
            UpdateOrderForm,
        },
        props: {
            order: Object,
        },
        methods: {
            formatPrice(amount) {
                return amount / 100
            },
        }
    }
</script>
