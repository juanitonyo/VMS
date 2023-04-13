<template>
  <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
    <div class="flex flex-grow flex-col overflow-y-auto bg-cyan-700 pt-5 pb-4">
      <div class="flex flex-shrink-0 items-center px-4 ">
        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=cyan&shade=300"
          alt="Easywire logo" />
          <span class="p-2 font-semibold text-cyan-300 text-xl">VMS</span>
      </div>
      <nav class="mt-5 flex flex-1 flex-col divide-y divide-cyan-800 overflow-y-auto justify-between" aria-label="Sidebar">
        <div class="space-y-1 px-2">
          <router-link v-for="item in sidebarNavigation" :key="item.name" :to="item.href"
            :class="[useRoute().path == item.href ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:bg-cyan-600 hover:text-white', 'group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6']"
            :aria-current="item.current ? 'page' : undefined">
            <component :is="item.icon" class="mr-4 h-6 w-6 flex-shrink-0 text-cyan-200" aria-hidden="true" />
            {{ item.name }}
          </router-link>
        </div>
        <div class="mt-6 pt-6">
          <div class="space-y-1 px-2">
            <router-link v-for="item in sideBarSecondaryNavigation" :key="item.name" :to="item.href"
              :class="[useRoute().path == item.href ? 'bg-cyan-800 text-white' : 'text-white hover:bg-cyan-600 hover:text-white', 'group flex items-center rounded-md px-2 py-2 text-sm font-medium leading-6']">
              <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
              {{ item.name }}
            </router-link>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { useRouter, useRoute } from 'vue-router'
import {
  Bars3CenterLeftIcon,
  BellIcon,
  ClockIcon,
  CogIcon,
  CreditCardIcon,
  DocumentChartBarIcon,
  HomeIcon,
  QuestionMarkCircleIcon,
  ScaleIcon,
  ShieldCheckIcon,
  UserGroupIcon,
  XMarkIcon,
  RectangleStackIcon,
  UsersIcon,
  BuildingOffice2Icon,
  TruckIcon,
  UserPlusIcon,
  UserIcon,
  QrCodeIcon
} from '@heroicons/vue/24/outline'
import {
  BanknotesIcon,
  BuildingOfficeIcon,
  CheckCircleIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  MagnifyingGlassIcon,
} from '@heroicons/vue/20/solid'

const sidebarNavigation = [
  { name: 'Dashboard', href: '/app/dashboard', icon: RectangleStackIcon },
  { name: 'Users', href: '/app/users', icon: UsersIcon },
  { name: 'Buildings', href: '/app/buildings', icon: BuildingOffice2Icon },
  { name: 'Visitors', href: '/app/visitors', icon: UserGroupIcon },
  { name: 'Deliveries', href: '/app/deliveries', icon: TruckIcon },
  // { name: 'Employee Reports', href: '#', icon: DocumentChartBarIcon },
  // { name: 'Employee Logs', href: '#', icon: UserPlusIcon },
]
const sideBarSecondaryNavigation = [
  // { name: 'Profile', href: '/app/profile', icon: UserIcon },
  { name: 'Maintenance', href: '/app/settings', icon: CogIcon },
  // { name: 'QR Codes', href: '#', icon: QrCodeIcon },
]

</script>