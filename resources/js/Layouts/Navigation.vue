<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
        <div class="py-4 text-gray-500">
            <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
                Windmill
            </Link>

            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </template>
                        Dashboard
                    </BreezeNavLink>
                </li>

                <li class="relative px-6 py-3" v-if="hasPermission(user,'view-user')">
                    <BreezeNavLink :href="route('users.index')" :active="route().current('users.index')">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </template>
                        Users
                    </BreezeNavLink>
                </li>


                <li class="relative px-6 py-3"
                    v-if="hasPermission(user,'view-role')||hasPermission(user,'view-permission')">
                    <button @click="showSecurityTabChildren = !showSecurityTabChildren"
                            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                            aria-haspopup="true">
                    <span class="inline-flex items-center">
                   <LockClosedIcon class="w-4"></LockClosedIcon>
                    <span class="ml-4">security</span>
                    </span>
                        <ChevronDownIcon class="w-4"></ChevronDownIcon>
                    </button>
                    <ul v-show="showSecurityTabChildren"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li v-if="hasPermission(user,'view-role')"
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <BreezeNavLink :href="route('roles.index')" :active="route().current('roles.index')">
                                roles
                            </BreezeNavLink>
                        </li>
                        <li v-if="hasPermission(user,'view-permission')"
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <BreezeNavLink :href="route('permissions.index')" :active="route().current('permissions.index')">
                                permissions
                            </BreezeNavLink>
                        </li>
                    </ul>
                </li>


                <li class="relative px-6 py-3">
                    <BreezeNavLink :href="route('about')" :active="route().current('about')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                        </template>
                        About us
                    </BreezeNavLink>
                </li>

                <li class="relative px-6 py-3">
                    <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
                            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                            aria-haspopup="true">
                <span class="inline-flex items-center">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Two-level menu</span>
                </span>
                        <ChevronDownIcon class="w-4"></ChevronDownIcon>
                    </button>
                    <ul v-show="showingTwoLevelMenu"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="#">Child menu</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
import BreezeNavLink from '@/Components/NavLink.vue'
import ChevronDownIcon from "@heroicons/vue/solid/ChevronDownIcon"
import LockClosedIcon from "@heroicons/vue/solid/LockClosedIcon"
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from 'vue'
// console.log(this.auth)

export default {
    components: {
        BreezeNavLink,
        ChevronDownIcon,
        LockClosedIcon,
        Link,
    }, data() {
        return {
            user: this.$page.props.auth.user
        }
    },


    setup() {
        let showingTwoLevelMenu = ref(false)
        let showSecurityTabChildren = ref(false)
        const hasPermission = (user, permissionName) => {

            const validRoles = user.roles.filter((role) => {
                return role.permissions.filter((permission) => {
                    return permission.name === permissionName
                }).length > 0
            })

            return validRoles.length > 0
        }

        return {
            hasPermission,
            showingTwoLevelMenu, showSecurityTabChildren
        }
    },
}
</script>
