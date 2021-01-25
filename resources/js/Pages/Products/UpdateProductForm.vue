<template>
    <jet-form-section @submitted="updateProduct">
        <template #title>
            Product
        </template>

        <template #description>
            Update product information
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden"
                       ref="image"
                       @change="updateImagePreview">

                <div class="mt-2" v-show="! imagePreview">
                    <img :src="getImage()" alt="" class="rounded h-20 w-20 object-cover">
                </div>

                <div class="mt-2" v-show="imagePreview">
                    <span class="block rounded w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewImage">
                    Select A New Image
                </jet-secondary-button>

                <jet-input-error :message="form.errors.image" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="title" value="Title" />
                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" />
                <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="description" value="Description" />
                <textarea id="description" v-model="form.description" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" cols="3" rows="5"></textarea>
                <jet-input-error :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="price" value="Price" />
                <jet-input id="price" type="text" class="mt-1 block w-full" v-model="form.price" />
                <jet-input-error :message="form.errors.price" class="mt-2" />
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
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSectionBorder,
            JetSecondaryButton,
        },

        props: ['product'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    title: this.product.title,
                    description: this.product.description,
                    image: this.getImage(),
                    price: this.product.price / 100,
                }),

                imagePreview: null,
            }
        },

        methods: {
            getImage() {
                return (this.product.image.includes('https://') ? '' : '/') + this.product.image
            },

            selectNewImage() {
                this.$refs.image.click();
            },

            updateImagePreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.image.files[0]);
            },

            formatPrice(amount) {
                return amount / 100
            },

            updateProduct() {
                this.form.price = this.form.price * 100

                if (this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }

                this.form.post(route('products.update', this.product), {
                    errorBag: 'updateOrder',
                    preserveScroll: true
                });
            },
        },
    }
</script>
