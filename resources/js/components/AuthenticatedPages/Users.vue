<template>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-3">
            <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">User</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Title</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Role</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Action</th>

                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="person in people" :key="person.email">
                                <td class="whitespace-nowrap text-center py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ person.name }}</td>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">{{ person.title }}</td>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">{{ person.email }}</td>
                                <td class="whitespace-nowrap text-center px-3 py-4 text-sm text-gray-500">{{ person.role }}</td>
                                <td class="relative whitespace-nowrap text-center py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                    >Edit<span class="sr-only">, {{ person.name }}</span></a
                                >
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</template>
  
  <script setup>
  import { UserMinusIcon, UserPlusIcon,UserIcon } from '@heroicons/vue/24/outline';
  import MobileMenu from '../Elements/Dashboard/MobileMenu.vue';
  import Sidebar from '../Elements/Dashboard/Sidebar.vue';
  import TopBar from '../Elements/Dashboard/TopBar.vue';

  const cards = [
    { name: 'Totol Visitors', href: '#', icon: UserIcon, amount: '150' },
    { name: 'Totol Checked In', href: '#', icon: UserPlusIcon, amount: '140' },
    { name: 'Totol Check Out ', href: '#', icon: UserMinusIcon, amount: '130' },
    ]

    
  const people = [
  
  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
]



  </script>