<template>
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">

        <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
            <div class="flex h-16 shrink-0 items-center">
                <img class="h-8 w-auto shadow rounded-full" src="/Visitor_Homepage_Assets/house.jpg"
                    alt="VMS" />
                <span class="p-2 font-semibold text-black text-xs">Visitor Management System</span>
            </div>
            <nav class="flex flex-1 flex-col justify-between" aria-label="Sidebar">
                <div class="-mx-2 space-y-2">
                    <div class="text-xs font-semibold leading-6 text-gray-600">VMS Tabs</div>
                    <router-link v-for="item in sidebarNavigation" :key="item.name" :to="item.href"
                        :class="[useRoute().path == item.href ? 'bg-gray-50 text-indigo-500' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']"
                        :aria-current="item.current ? 'page' : undefined">
                        <component :is="item.icon"
                            :class="[item.current ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-800', 'h-6 w-6 shrink-0']"
                            aria-hidden="true" />
                        {{ item.name }}
                    </router-link>
                </div>

                <!-- <div class="mt-6 pt-6">
                    <div class="-mx-2 space-y-2">
                        <div class="text-xs font-semibold leading-6 text-indigo-200">VMS Settings</div>
                        <router-link v-for="item in sideBarSecondaryNavigation" :key="item.name" :to="item.href"
                            :class="[useRoute().path == item.href ? 'bg-gray-700 text-white' : 'text-gray-200 hover:text-white hover:bg-gray-700', 'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal']">
                            <component :is="item.icon" class="mr-4 h-6 w-6 text-gray-200" aria-hidden="true" />
                            {{ item.name }}
                        </router-link>
                    </div>
                </div> -->
            </nav>
        </div>
    </div>
</template>
  
<script setup>
import { useRouter, useRoute } from 'vue-router'
import {
    CogIcon,
    UserGroupIcon,
    RectangleStackIcon,
    UsersIcon,
    BuildingOffice2Icon,
    TruckIcon,
} from '@heroicons/vue/24/outline'

const sidebarNavigation = [
    { name: 'Dashboard', href: '/homeowner/dashboard', icon: RectangleStackIcon },
]

// const sideBarSecondaryNavigation = [
//     { name: 'Maintenance', href: '/app/settings', icon: CogIcon },
// ]


</script>
  