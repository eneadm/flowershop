<template>
    <jet-form-section @submitted="updateOrder">
        <template #title>
            Order
        </template>

        <template #description>
            Update order information
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select v-model="form.status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option v-for="status in ['in_review', 'shipped']" :value.sync="status">
                        {{ status.toUpperCase() }}
                    </option>
                </select>
            </div>
            <div class="col-span-6 sm:col-span-4" v-if="order.items.length">
                <jet-section-border />
                <div class="flex justify-between" v-for="item in order.items">
                    <div>{{ item.title.toUpperCase() }}</div>
                    <div>x{{ item.quantity }} - ${{ formatPrice(item.price) }}</div>
                </div>
                <div class="text-right mt-6">
                    Total: ${{ formatPrice(order.total) }}
                </div>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetSectionBorder from "@/Jetstream/SectionBorder";

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSectionBorder,
        },

        props: ['order'],

        data() {
            return {
                form: this.$inertia.form({
                    status: this.order.status,
                })
            }
        },

        methods: {
            formatPrice(amount) {
                return amount / 100
            },

            updateOrder() {
                this.form.put(route('orders.update', this.order), {
                    errorBag: 'updateOrder',
                    preserveScroll: true
                });
            },
        },
    }
</script>
