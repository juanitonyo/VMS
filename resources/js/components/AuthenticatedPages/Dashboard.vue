<template>
    <div class="mt-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold leading-6 text-gray-900">Overview</h2>
            <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Cards -->
                <div class="overflow-hidden rounded-lg bg-white shadow-sm shadow-indigo-300">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="gray" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-700">Total Visitors</dt>
                                    <div class="flex space-x-2">
                                        <p class="text-lg font-medium text-indigo-900">{{ this.numVisitors }}</p>
                                        <!-- vshow -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="green" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                        </svg>
                                    </div>
                                    <p class="text-[11px] text-gray-400">from yesterdays: 52</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg bg-white shadow-sm shadow-green-300">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="gray" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-700">Total Checked In</dt>
                                    <div class="flex space-x-2">
                                        <p class="text-lg font-medium text-indigo-900">{{ this.numLogs }}</p>
                                        <!-- vshow -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="red" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                                        </svg>

                                    </div>
                                    <p class="text-[11px] text-gray-400">from yesterdays: 130</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-lg bg-white shadow-sm shadow-red-300">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="gray" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-700">Total Checked Out</dt>
                                    <div class="flex space-x-2">
                                        <p class="text-lg font-medium text-indigo-900">{{ this.numCheckouts }}</p>
                                        <!-- vshow -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="green" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                        </svg>
                                    </div>
                                    <p class="text-[11px] text-gray-400">from yesterdays: 102</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-5">
        <div class="flex justify-between">
            <h2 class="text-2xl font-extrabold leading-6 text-gray-900 py-4">Visitor Logs</h2>
            <!-- <h2 class="text-2xl font-extrabold leading-6 text-gray-900 py-4">Filter Here</h2> -->
        </div>
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Checked In</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all checked in users including their name,
                        email and time.</p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Email</th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            First Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Last Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Checked In</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.visitor.id">
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ console.log(item.visitor.email) }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                            {{ item.visitor.name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">Last Name
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ moment(item.visitor.created_at) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Checked Out</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all checked out users including their name,
                        email and time.</p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Email</th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            First Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Last Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Checked Out</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="person in this.visitorCheckOuts" :key="person.id">
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ person.email }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                            {{ person.name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ person.title }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{ person.role }}</td>
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
  
<script>
import { UserMinusIcon, UserPlusIcon, UserIcon } from '@heroicons/vue/24/outline';
import axios from 'axios';
import MobileMenu from '../Elements/Dashboard/MobileMenu.vue';
import Sidebar from '../Elements/Dashboard/Sidebar.vue';
import TopBar from '../Elements/Dashboard/TopBar.vue';
import moment from 'moment';

export default {
    name: 'Dashboard',
    props: {
        data: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            data: {},
            length: '',
            // cards: [
            //     { name: 'Totol Visitors', href: '#', icon: UserIcon, amount: '150' },
            //     { name: 'Totol Checked In', href: '#', icon: UserPlusIcon, amount: '140' },
            //     { name: 'Totol Check Out ', href: '#', icon: UserMinusIcon, amount: '130' },
            // ],
            people: [
                { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
            ],
            visitors: {},
            visitorLogs: {},
            visitorCheckOuts: {},
            accountsCheckIn: {},
            numVisitors: '',
            numLogs: '',
            numCheckouts: ''
        }
    },
    methods: {
        async getData() {
            await axios.get('/api/visitor-registration/')
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                }); 
        },
        async getVisitors() {
            await axios.get('/api/visitors/')
                .then((data) => {
                    this.visitors = data.data.data;
                    this.numVisitors = this.visitors.total;
                }).catch((e) => {

                });
        },
        async getVisitorLogs() {
            await axios.get('/api/visitor-logs/')
                .then((data) => {
                    this.visitorLogs = data.data.data;
                    this.numLogs = this.visitorLogs.total;
                }).catch((e) => {

                });
        },
        async getCheckOuts() {
            await axios.get('/api/get-checkouts/')
                .then((data) => {
                    this.visitorCheckOuts = data.data.data;
                    this.numCheckouts = this.visitorCheckOuts.length
                }).catch((e) => {

                });
        }
    },
    created() {
        this.getVisitors();
        this.getVisitorLogs();
        this.getCheckOuts();
        this.moment = moment
    }
}

</script>