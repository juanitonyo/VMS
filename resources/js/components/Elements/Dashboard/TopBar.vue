<template>
  <TransitionRoot as="template" :show="sidebarOpen">
    <Dialog as="div" class="relative lg:hidden" @close="sidebarOpen = false">
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
            <div class="flex grow flex-col gap-y-10 overflow-y-auto bg-white px-6 pb-4 font-poppins">
              <a href="/app/dashboard" class="cursor-pointer flex h-16 shrink-0 items-center pt-5 px-2">
                <img class="h-[70px] w-[200px]" src="/logo/vms_logo.png" alt="VMS" />
              </a>

              <div class="text-center">

                <div class="w-full h-[1.5px] bg-gray-200"></div>
                <div class="py-3">
                  <p class="font-bold text-blue-800">GlobalSpaces Shaw</p>
                  <p class="font-extralight text-sm">{{ store.user.name }}</p>
                </div>
                <div class="w-full h-[1.5px] bg-gray-200"></div>
              </div>

              <nav class="flex flex-1 flex-col justify-between" aria-label="Sidebar">
                <div class="-mx-2 space-y-2">
                  <div v-for="item in sidebarNavigation" v-if="permissions">
                    <router-link v-if="item.access" @click="toggleDropdown(item)" :key="item.name" :to="item.href" :class="[
                      useRoute().path == item.href
                        ? 'bg-gray-50 text-gray-700'
                        : 'text-gray-700 hover:bg-gray-50',
                      'group flex gap-x-3 rounded-xl p-2 text-sm leading-6 font-normal',
                    ]" :aria-current="item.current ? 'page' : undefined">
                      <component :is="item.icon" class="mr-4 h-6 w-6 flex-shrink-0 text-blue-500" aria-hidden="true" />
                      {{ item.name }}
                    </router-link>
                    <ul v-if="item.subMenu" v-for="sub in item.subMenu" :key="sub.name" v-show="item.dropdown"
                      class="mt-2">
                      <li>
                        <router-link v-if="sub.access" :to="sub.href" :class="[
                          useRoute().path == sub.href
                            ? 'bg-gray-50 text-gray-700'
                            : 'text-gray-700 hover:bg-gray-50',
                          'flex rounded-md py-2 pr-2 pl-9 text-sm leading-6 ',
                        ]">
                          <ChevronRightIcon class="mr-4 mt-1 h-4 w-6 flex-shrink-0 text-blue-800" aria-hidden="true" />
                          {{ sub.name }}
                        </router-link>
                      </li>
                    </ul>
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
      class="top-0 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
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
              <img class="h-8 w-9 rounded-full bg-gray-50 text-[8px] flex items-center justify-center"
                src="/Visitor_Homepage_Assets/user_icon.jpg" alt="no photo" />
              <span class="hidden lg:flex lg:items-center">
                <span class="ml-4 text-sm font-normal leading-6 text-gray-900" aria-hidden="true">{{ user_full_name
                }}</span>
                <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
              </span>
            </MenuButton>
            <transition enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95">
              <MenuItems
                class="absolute right-0 z-10 mt-2.5 w-[150px] origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                <button @click="pop = true"
                  :class="[active ? 'bg-gray-100' : '', 'block w-full px-4 py-2 text-sm text-gray-700']">Profile
                  Settings</button>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                <button @click="logout"
                  :class="[active ? 'bg-gray-100' : '', 'block w-full px-4 py-2 text-sm text-gray-700']">Logout</button>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>
  </div>

  <DialogVue :show="pop" :dialogTitle="changePass ? 'Change Password' : 'Update Profile'" id="profile"
    :modalWidth="'max-w-4xl'" :modalHeight="'h-[400px]'">
    <template v-slot:dialogBody>
      <div v-show="!changePass" class="container mx-auto">
        <form>
          <div class="grid text-sm grid-cols-3">
            <div class="text-gray-600">
              <div class="flex justify-center items-center flex-col lg:mt-16 my-4">
                <div class="lg:w-40 w-28">
                  <label for="profile"
                    class="flex flex-col lg:w-40 w-28 lg:h-40 h-28 border-2 hover:bg-gray-200 opacity-60 rounded-full justify-center items-center cursor-pointer transition duration-500">
                    <img class="lg:w-8 w-6 mt-3 lg:mt-0" src="https://www.svgrepo.com/show/33565/upload.svg" />
                    <input id="profile" type="file" class="flex items-center h-5 border rounded px-4 w-full opacity-0">
                  </label>
                </div>
                <p class="text-[10px]">Change Photo</p>
              </div>
            </div>

            <div class="lg:col-span-2">
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-5 relative">
                  <div class="flex justify-between">
                    <label for="firstName" class="text-xs">First Name</label>
                  </div>
                  <input disabled type="text" name="firstName" id="firstName" placeholder="Juan"
                    class="text-xs border rounded px-4 mt-1 h-8 w-full" />
                </div>

                <div class="md:col-span-5 relative">
                  <div class="flex justify-between">
                    <label for="lastName" class="text-xs">Last Name</label>
                  </div>
                  <input disabled type="text" name="lastName" id="lastName" placeholder="Dela Cruz"
                    class="text-xs border rounded px-4 mt-1 h-8 w-full" />
                </div>

                <div class="md:col-span-3 relative">
                  <div class="flex justify-between">
                    <label for="email" class="text-xs">Email Address</label>
                  </div>
                  <input disabled type="text" name="email" id="email" class="text-xs border rounded px-4 mt-1 h-8 w-full"
                    placeholder="example@domain.com" autocomplete="off" />
                </div>

                <div class="md:col-span-2 relative">
                  <div class="flex justify-between">
                    <label for="password" class="text-xs">Password</label>
                  </div>
                  <button @click.prevent="changePassword()"
                    class="flex items-center justify-center mt-1 h-8 w-full space-x-1 border rounded hover:bg-blue-100/90">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                    <p class="text-xs">Change Password</p>
                  </button>
                </div>

                <!-- <div class="md:col-span-3 relative">
                  <div class="flex justify-between">
                    <label for="location" class="text-xs">Unit Number / Location</label>
                  </div>
                  <input type="text" name="location" id="location" placeholder="Enter Unit / Location"
                    class="text-xs border rounded px-4 mt-1 h-8 w-full" />
                </div> -->

                <div class="md:col-span-2 relative">
                  <div class="flex justify-between">
                    <label for="contact" class="text-xs">Mobile Number</label>
                  </div>
                  <input type="tel" name="contact" id="contact" placeholder="09*********"
                    class=" text-xs border rounded px-4 mt-1 h-8 w-full" />
                </div>

                <div class="md:col-span-3 relative">
                  <div class="flex justify-between">
                    <label for="gov_id" class="text-xs">Government - Issued Valid ID</label>
                  </div>
                  <div class="valid_ids flex items-center mt-1">
                    <v-select id="gov_id" :options="gov_id" :placeholder="'Valid ID'"
                      class="text-xs border rounded px-4 h-8 w-full">
                    </v-select>
                  </div>
                </div>

                <div class="md:col-span-1">
                  <p class="text-xs">Front</p>
                  <label for="frontId"
                    class="mt-1 flex flex-col items-center justify-center w-full h-[73px] border rounded-md cursor-pointer hover:bg-blue-100/90 bg-cover bg-no-repeat">
                    <div class="flex flex-col items-center justify-center pt-6 pb-6">
                      <img src="/Visitor_Homepage_Assets/frontID.png">
                    </div>
                    <input id="frontId" ref="front" type="file"
                      class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50 opacity-0"
                      @input="" />
                  </label>
                </div>

                <div class="md:col-span-1">
                  <p class="text-xs">Back</p>
                  <label for="backId"
                    class="mt-1 flex flex-col items-center justify-center w-full h-[73px] border rounded-md cursor-pointer hover:bg-blue-100/90 bg-cover bg-no-repeat">
                    <div class="flex flex-col items-center justify-center pt-6 pb-6">
                      <img src="/Visitor_Homepage_Assets/backID.png">
                    </div>
                    <input id="backId" ref="front" type="file"
                      class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50 opacity-0"
                      @input="" />
                  </label>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="space-x-3 flex mt-5">
          <button @click="pop = false"
            class="w-full h-8 border border-black rounded-md font-semibold tracking-wide">Close</button>
          <button class="w-full h-8 bg-gray-900 text-white rounded-md font-semibold tracking-wide">Update</button>
        </div>

      </div>


      <div v-show="changePass" class="">
        <div class="h-[300px] flex flex-col items-center justify-center">

          <form class="flex flex-col items-center">

            <div class="w-[400px]">
              <label for="" class="text-xs">Current Password</label>
              <input type="text" name="" id="" placeholder=""
                class="text-xs border rounded mt-1 px-4 h-8 w-full focus:outline-none" />
            </div>

            <div class="w-[400px]">
              <label for="" class="text-xs">New Password</label>
              <input type="text" name="" id="" placeholder=""
                class="text-xs border rounded mt-1 px-4 h-8 w-full focus:outline-none" />
            </div>

            <div class="w-[400px]">
              <label for="" class="text-xs">Confirm Password</label>
              <input type="text" name="" id="" placeholder=""
                class="text-xs border rounded mt-1 px-4 h-8 w-full focus:outline-none" />
            </div>

          </form>
        </div>

        <div class="flex space-x-3 mt-[53px]">
          <button @click="changePass = false"
            class="w-full h-8 border border-black rounded-md font-semibold tracking-wide">Back</button>
          <button class="w-full h-8 bg-gray-900 text-white rounded-md font-semibold tracking-wide">Save</button>
        </div>
      </div>
    </template>
  </DialogVue>
</template>

<script setup>
import { ref } from 'vue';
import { reactive } from "vue";
import { userAuthStore } from "@/store/auth";
import { useRoute, useRouter } from "vue-router";
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
  ChevronRightIcon,
  ShareIcon,
  QrCodeIcon,
  ArrowLeftIcon
} from '@heroicons/vue/24/outline'
import {
  ChevronDownIcon,
} from '@heroicons/vue/20/solid'

let permissions = userAuthStore().role.permissions;
let activeDropdown = ref(null);
const store = userAuthStore();

const toggleDropdown = (item) => {
  if (activeDropdown.value === item) {
    item.dropdown = false;
    activeDropdown.value = null;
  } else {
    if (activeDropdown.value) {
      activeDropdown.value.dropdown = false;
    }
    item.dropdown = true;
    activeDropdown.value = item;
  }
};

const sidebarNavigation = reactive([
  {
    name: "Dashboard",
    href: "/app/dashboard",
    icon: RectangleStackIcon,
    access: permissions.dashboard ?? false,
  },
  {
    name: "Manage Users",
    href: "/app/users",
    icon: UsersIcon,
    access: (permissions.users || permissions.roles) ?? false,
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
    name: "Manage Visitors",
    href: "/app/visitors",
    icon: UserGroupIcon,
    access: (permissions.visitors || permissions.invite) ?? false,
    dropdown: false,
    subMenu: [
      {
        name: "Visitor Log",
        href: "/app/visitors",
        access: permissions.visitors ?? false,
      },
      {
        name: "Invitation Log",
        href: "/app/invite",
        access: permissions.invite ?? false,
      },
    ],
  },
  {
    name: "Manage Deliveries",
    href: "/app/deliveries",
    icon: TruckIcon,
    access: (permissions.deliveries || permissions.expected) ?? false,
    dropdown: false,
    subMenu: [
      {
        name: "Delivery Log",
        href: "/app/deliveries",
        access: permissions.deliveries ?? false,
      },
      {
        name: "Expected Deliveries",
        href: "/app/expected",
        access: permissions.expected ?? false,
      },
    ],
  },
  {
    name: "Front Page",
    href: "/guests",
    icon: ArrowLeftIcon,
  },
  {
    name: "QR Codes",
    href: "/app/qrcode",
    icon: QrCodeIcon,
    access: permissions.qrcode ?? false,
  },
  {
    name: "Maintenance",
    href: "/app/settings",
    icon: CogIcon,
    access: permissions.settings ?? false,
  },
  {
    name: "Sync Proptech Data",
    href: "/app/sync",
    icon: ShareIcon,
    access: permissions.sync ?? false,
  },
]);


const gov_id = [
  "Digitalized BIR Taxpayer's ID",
  'Digitized Postal ID',
  'Diplomat ID',
  "Driver's License",
  'GSIS Card',
  'IBP ID',
  'OFW ID',
  'OWWA ID',
  'Passport',
  'PRC ID',
  "Senior Citizen's ID Card",
  'SSS Card',
  'UMID Card',
  "Voter's ID"
]

const user_full_name = ref(userAuthStore().user.name);
const pop = ref(false)
const sidebarOpen = ref(false)
const router = useRouter();

const logout = async () => {
  await axios.post('/logout').then(({ data }) => {
    userAuthStore().signOut();
    router.push({ name: 'login' })
  });
};

</script>

<script>
export default {
  data() {
    return {
      changePass: false
    }
  },
  methods: {
    changePassword() {
      this.changePass = !this.changePass
    }
  }
}
</script>
