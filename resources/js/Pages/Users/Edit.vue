<template>
    <Head ><title>edit user</title></Head>

    <BreezeAuthenticatedLayout>

        <div v-show="$page.props.flash.success"
             class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-xs">

            <BreezeValidationErrors class="mb-4"/>

            <form @submit.prevent="submit">

                <div class="flex items-center">

                    <FileInput v-model="form.avatar_img" :preview="$props.user.avatar_img" label="profile image"/>
                    <div>
                        <TrashIcon onclick="" class="h-5 w-5 text-red-400 cursor-pointer hover:text-red-700"/>
                    </div>
                </div>

                <div class="mt-4">
                    <BreezeLabel for="name" value="Name *"/>
                    <BreezeInput
                        id="name"
                        type="text"
                        class="block mt-1 w-full"
                        v-model="form.name"
                        required
                    />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="name" value="Email *"/>
                    <BreezeInput
                        id="email"
                        type="text"
                        class="block mt-1 w-full"
                        v-model="form.email"
                        required
                    />
                </div>
                <Button
                    class="block mt-4 w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Submit
                </Button>
            </form>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeInput from "@/Components/Input";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeLabel from "@/Components/Label"
import {Head, useForm} from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import TrashIcon from "@heroicons/vue/solid/TrashIcon";
import FileInput from "@/Components/FileInput";

export default {
    name: "Edit",
    components: {
        Button, FileInput, TrashIcon,
        BreezeLabel,
        BreezeInput, BreezeAuthenticatedLayout,
        BreezeValidationErrors,
        Head
    },
    props: {
        user: Object,
    },
    data() {
        return {
            form: useForm(
                {
                    _method: "put",
                    avatar_img: "",
                    name: this.$props.user.name,
                    email: this.$props.user.email
                }
            )
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('users.update', this.$props.user.id));
        }
    }
}
</script>

<style scoped>

</style>
