<template>
    <Head><title>roles</title></Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            Roles
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">permissions</th>
                            <th class="px-4 py-3">actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                        <tr v-for="role in roles.data" :key="role.id" class="text-gray-700">
                            <td class="px-4 py-3 ">
                                <Link :href="route('roles.show',{role:role.id})">
                                    {{ role.name }}
                                </Link>
                            </td>
                            <td class="px-4 py-3 text-sm flex flex-wrap">
                                <div
                                    v-for="permission in role.permissions"
                                    class="mr-1 mb-1 px-2 py-1 text-sm leading-4 border rounded
                                    hover:bg-white focus:border-indigo-500 focus:text-indigo-500" >
                                        {{permission.name}}
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="flex flex-row">
                                    <Link :href="route('roles.edit',{role:role.id})">
                                        <PencilIcon class="h-6 w-6 text-yellow-600"/>
                                    </Link>
                                    <!--                                                                        <TrashIcon class="h-5 w-5 text-red-500" />-->
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    <pagination :links="roles.links"/>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import PencilIcon from "@heroicons/vue/outline/PencilAltIcon";
import TrashIcon from "@heroicons/vue/solid/TrashIcon";
import {Link} from "@inertiajs/inertia-vue3";
import AvatarImg from "@/Components/AvatarImg";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import Pagination from "@/Components/Pagination";

export default {
    name: "List",
    components: {
        PencilIcon,
        TrashIcon,
        Link,
        AvatarImg,
        BreezeAuthenticatedLayout,
        Pagination,
    },
    props: {
        roles: Object,
    },

}
</script>

<style scoped>

</style>
