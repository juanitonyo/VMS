<template>
  <TransitionRoot as="template" :show="sidebarOpen">
    <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
      <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
        enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
        leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-900/80" />
      </TransitionChild>

      <div class="fixed inset-0 flex">
        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0" leave-to="-translate-x-full">
          <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
              leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-10 overflow-y-auto bg-gray-900 px-6 pb-4">
              <div class="flex h-16 shrink-0 items-center">
                <img class="h-8 w-auto" src="https://visitor.globalland.com.ph/vendor/adminlte/dist/img/AdminLTELogo.png"
                  alt="VMS" />
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
          </DialogPanel>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>

  <div class="lg:pl-72">
    <div
      class="top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
      <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <Bars3CenterLeftIcon class="h-6 w-6" aria-hidden="true" />
      </button>

      <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true" />

      <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end">
        <div class="flex items-center gap-x-4 lg:gap-x-6">
          <Menu as="div" class="relative">
            <MenuButton class="-m-1.5 flex items-center p-1.5">
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full bg-gray-50" src="https://picsum.photos/80" alt="No Photo" />
              <span class="hidden lg:flex lg:items-center">
                <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ user_full_name
                }}</span>
                <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
              </span>
            </MenuButton>
            <transition enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95">
              <MenuItems
                class="absolute right-0 z-10 mt-2.5 w-full origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                <button @click.prevent="pop = true"
                  :class="[active ? 'bg-gray-100' : '', 'w-full px-4 py-2 text-sm text-gray-700']">Profile
                  Settings</button>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                <button @click.prevent="logout"
                  :class="[active ? 'bg-gray-100' : '', 'w-full px-4 py-2 text-sm text-gray-700']">Logout</button>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>
  </div>

  <DialogVue :isOpen="pop" :dialogTitle="'Profile'" id="profile">
    <template v-slot:dialogBody>
      henlo
      <button @click="pop = false" class="bg-red-600">close</button>
    </template>
  </DialogVue>

  <DialogVue :isOpen="open" :dialogTitle="'Settings'" id="settings">
    <template v-slot:dialogBody>
      hihihih

      <button @click="open = false" class="bg-blue-600">close</button>
    </template>
  </DialogVue>
</template>

<script setup>
import { ref } from 'vue';
import { userAuthStore } from '@/store/auth';
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'


import {
  Dialog,
  DialogPanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'

import {
  Bars3CenterLeftIcon,
  CogIcon,
  UserGroupIcon,
  XMarkIcon,
  RectangleStackIcon,
  UsersIcon,
  BuildingOffice2Icon,
  TruckIcon,
} from '@heroicons/vue/24/outline'
import {
  ChevronDownIcon,
} from '@heroicons/vue/20/solid'

const sidebarNavigation = [
  { name: 'Dashboard', href: '/app/dashboard', icon: RectangleStackIcon },
  { name: 'Users', href: '/app/users', icon: UsersIcon },
  { name: 'Buildings', href: '/app/buildings', icon: BuildingOffice2Icon },
  { name: 'Visitors', href: '/app/visitors', icon: UserGroupIcon },
  { name: 'Deliveries', href: '/app/deliveries', icon: TruckIcon },
]
const sideBarSecondaryNavigation = [
  { name: 'Maintenance', href: '/app/settings', icon: CogIcon },
]

const user_full_name = ref(userAuthStore().user.name);
const pop = ref(false)
const open = ref(false)
const sidebarOpen = ref(false)
const router = useRouter();

const logout = async () => {
  await axios.post('/logout').then(({ data }) => {
    userAuthStore().signOut();
    router.push({ name: 'login' })
  });
};

</script>
