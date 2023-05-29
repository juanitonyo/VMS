<template>
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
        <div
            class="flex grow flex-col gap-y-10 overflow-y-auto bg-gray-900 px-6 pb-4"
        >
            <div class="flex h-16 shrink-0 items-center">
                <img
                    class="h-8 w-auto"
                    src="https://visitor.globalland.com.ph/vendor/adminlte/dist/img/AdminLTELogo.png"
                    alt="VMS"
                />
                <span class="p-2 font-semibold text-gray-300 text-xs"
                    >Visitor Management System</span
                >
            </div>
            <nav
                class="flex flex-1 flex-col justify-between"
                aria-label="Sidebar"
            >
                <div class="-mx-2 space-y-2">
                    <div
                        class="text-xs font-semibold leading-6 text-indigo-200"
                    >
                        VMS Tabs
                    </div>
                    <div v-for="item in sidebarNavigation" v-if="permissions">
                        <router-link
                            v-if="item.access"
                            @click="item.dropdown = !item.dropdown"
                            :key="item.name"
                            :to="item.href"
                            :class="[
                                useRoute().path == item.href
                                    ? 'bg-gray-700 text-white'
                                    : 'text-gray-200 hover:text-white hover:bg-gray-700',
                                'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal',
                            ]"
                            :aria-current="item.current ? 'page' : undefined"
                        >
                            <component
                                :is="item.icon"
                                class="mr-4 h-6 w-6 flex-shrink-0 text-gray-200"
                                aria-hidden="true"
                            />
                            {{ item.name }}
                        </router-link>
                        <ul
                            v-if="item.subMenu"
                            v-for="sub in item.subMenu"
                            :key="sub.name"
                            v-show="item.dropdown"
                            class="mt-2"
                        >
                            <li>
                                <router-link
                                    v-if="sub.access"
                                    :to="sub.href"
                                    :class="[
                                        useRoute().path == sub.href
                                            ? 'bg-gray-700 text-white'
                                            : 'text-gray-200 hover:text-white hover:bg-gray-700',
                                        'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal',
                                    ]"
                                >
                                    <ChevronRightIcon
                                        class="mr-4 h-6 w-6 flex-shrink-0 text-gray-200 invisible"
                                        aria-hidden="true"
                                    />
                                    {{ sub.name }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-6 pt-6">
                    <div class="-mx-2 space-y-2" v-if="permissions.settings">
                        <div
                            class="text-xs font-semibold leading-6 text-indigo-200"
                        >
                            VMS Settings
                        </div>
                        <router-link
                            v-for="item in sideBarSecondaryNavigation"
                            :key="item.name"
                            :to="item.href"
                            :class="[
                                useRoute().path == item.href
                                    ? 'bg-gray-700 text-white'
                                    : 'text-gray-200 hover:text-white hover:bg-gray-700',
                                'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal',
                            ]"
                        >
                            <component
                                :is="item.icon"
                                class="mr-4 h-6 w-6 text-gray-200"
                                aria-hidden="true"
                            />
                            {{ item.name }}
                        </router-link>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { userAuthStore } from "@/store/auth";
import { useRoute } from "vue-router";
import {
    CogIcon,
    UserGroupIcon,
    RectangleStackIcon,
    UsersIcon,
    BuildingOffice2Icon,
    TruckIcon,
    ChevronRightIcon,
} from "@heroicons/vue/24/outline";

let permissions = userAuthStore().role.permissions;

const sidebarNavigation = reactive([
    {
        name: "Dashboard",
        href: "/app/dashboard",
        icon: RectangleStackIcon,
        access: permissions.dashboard ?? false,
    },
    {
        name: "Manage Users",
        href: "#",
        icon: UsersIcon,
        access: (permissions.users || permissions.roles) ?? false ,
        dropdown: false,
        subMenu: [
            {
                name: "List",
                href: "/app/users",
                access: permissions.users ?? false,
            },
            {
                name: "Roles",
                href: "/app/roles",
                access: permissions.roles ?? false,
            },
        ],
    },
    {
        name: "Buildings",
        href: "/app/buildings",
        icon: BuildingOffice2Icon,
        access: permissions.buildings ?? false,
    },
    {
        name: "Visitors",
        href: "/app/visitors",
        icon: UserGroupIcon,
        access: permissions.visitors ?? false,
    },
    {
        name: "Deliveries",
        href: "/app/deliveries",
        icon: TruckIcon,
        access: permissions.deliveries ?? false,
    },
]);

const sideBarSecondaryNavigation = [
    {
        name: "Maintenance",
        href: "/app/settings",
        icon: CogIcon,
        access: permissions.settings ?? false,
    },
];
</script>
