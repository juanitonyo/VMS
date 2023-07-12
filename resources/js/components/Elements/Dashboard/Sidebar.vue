<template>
  <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col border-r">
    <div class="flex grow flex-col gap-y-10 overflow-y-auto bg-white px-6 pb-4">
      <a href="/app/dashboard" class="cursor-pointer flex items-center mt-5 px-2 focus:outline-none">
        <img class="h-[70px] w-[200px]" src="/logo/vms_logo.png" alt="VMS" />
      </a>

      <div class="text-center">

        <div class="w-full h-[1.5px] bg-gray-200"></div>
        <div class="py-3">
          <p class="font-bold text-blue-800">GlobalSpaces Shaw</p>
          <p class="font-extralight text-sm">{{ (this.data ?? false) ? this.data.first_name + ' ' + this.data.last_name : store.user.name }}</p>
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
            <ul v-if="item.subMenu" v-for="sub in item.subMenu" :key="sub.name" v-show="item.dropdown" class="mt-2">
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
  </div>
</template>

<script>
import axios from 'axios';
import { userAuthStore } from "@/store/auth";

const store = userAuthStore();

export default {
  props: {
    data: {
      type: Object,
      default: {}
    }
  },
  data() {
    return {
      data: {},
      account: {}
    }
  },
  methods: {
    syncUser() {
      axios.get('/api/sync-user-host?id=' + store.user.id)
        .then((data) => { this.data = data.data.data; console.log(this.data); })
        .catch((error) => {})
    }
  },
  created() {
    this.syncUser();
  },
}
</script>

<script setup>
import { reactive, ref } from "vue";
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
  ShareIcon,
  QrCodeIcon,
  ArrowLeftIcon
} from "@heroicons/vue/24/outline";

let permissions = userAuthStore().role.permissions;
let activeDropdown = ref(null);
const store = userAuthStore();

const toggleDropdown = (item) => {
  if (activeDropdown.value === item) {
    // Clicked on the same dropdown item, so close it
    item.dropdown = false;
    activeDropdown.value = null;
  } else {
    // Close the previously active dropdown and open the clicked one
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

</script>
