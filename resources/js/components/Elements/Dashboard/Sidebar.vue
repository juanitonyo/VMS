<template>
  <!-- <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
    <div class="flex flex-grow flex-col overflow-y-auto bg-cyan-700 pt-5 pb-4 shadow ring-black ring-opacity-5">
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
  </div> -->

  <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-10 overflow-y-auto bg-gray-900 px-6 pb-4">
        <div class="flex h-16 shrink-0 items-center">
          <img class="h-8 w-auto" src="https://visitor.globalland.com.ph/vendor/adminlte/dist/img/AdminLTELogo.png" alt="VMS" />
          <span class="p-2 font-semibold text-gray-300 text-xs">Visitor Management System</span>
        </div>
        <nav class="flex flex-1 flex-col justify-between" aria-label="Sidebar">
          <div class="-mx-2 space-y-2">
            <div class="text-xs font-semibold leading-6 text-indigo-200">VMS Tabs</div>
            <router-link v-for="item in sidebarNavigation" :key="item.name" :to="item.href"
              :class="[useRoute().path == item.href ? 'bg-gray-700 text-white' : 'text-gray-200 hover:text-white hover:bg-gray-700', 'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal']"
              :aria-current="item.current ? 'page' : undefined">
              <component :is="item.icon" class="mr-4 h-6 w-6 flex-shrink-0 text-gray-200" aria-hidden="true" />
              {{ item.name }}
            </router-link>
          </div>

          <div class="mt-6 pt-6">
            <div class="-mx-2 space-y-2">
            <div class="text-xs font-semibold leading-6 text-indigo-200">VMS Settings</div>
              <router-link v-for="item in sideBarSecondaryNavigation" :key="item.name" :to="item.href"
                :class="[useRoute().path == item.href ? 'bg-gray-700 text-white' : 'text-gray-200 hover:text-white hover:bg-gray-700', 'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal']">
                <component :is="item.icon" class="mr-4 h-6 w-6 text-gray-200" aria-hidden="true" />
                {{ item.name }}
              </router-link>
            </div>
          </div>
        </nav>
      </div>
    </div>

</template>

<script setup>
import { ref } from 'vue';
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


<!-- <nav class="flex flex-1 flex-col">
  <ul role="list" class="flex flex-1 flex-col gap-y-7">
    <li>
      <ul role="list" class="-mx-2 space-y-1">
        <li v-for="item in navigation" :key="item.name">
          <a :href="item.href" :class="[item.current ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
            <component :is="item.icon" :class="[item.current ? 'text-white' : 'text-indigo-200 group-hover:text-white', 'h-6 w-6 shrink-0']" aria-hidden="true" />
            {{ item.name }}
          </a>
        </li>
      </ul>
    </li>
    <li>
      <div class="text-xs font-semibold leading-6 text-indigo-200">VMS</div>
      <ul role="list" class="-mx-2 mt-2 space-y-1">
        <li v-for="team in teams" :key="team.name">
          <a :href="team.href" :class="[team.current ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-indigo-400 bg-indigo-500 text-[0.625rem] font-medium text-white">{{ team.initial }}</span>
            <span class="truncate">{{ team.name }}</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="mt-auto">
      <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-indigo-200 hover:bg-indigo-700 hover:text-white">
        <Cog6ToothIcon class="h-6 w-6 shrink-0 text-indigo-200 group-hover:text-white" aria-hidden="true" />
        Settings
      </a>
    </li>
  </ul>
</nav> -->