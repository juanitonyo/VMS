<template>
    <div class="mt-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <DateFilter @filter-date="filterData"></DateFilter>
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
                                    <p class="text-2xl font-bold text-indigo-900">{{ this.numLogs }}</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div> -->
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
                                    <p class="text-2xl font-bold text-indigo-900">{{ this.numLogs }}</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div> -->
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
                                    <p class="text-2xl font-bold text-indigo-900">{{ this.numCheckouts }}</p>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="bg-gray-50 px-5 py-3">
                        <div class="text-xs">
                            <a href="#" class="font-medium text-gray-700 hover:text-gray-900">View all</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-5">
        <div class="flex justify-between">
            <h2 class="text-2xl font-extrabold leading-6 text-gray-900 py-4">Visitor Logs</h2>
        </div>
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Checked In</h1>
                    <p class="mt-2 text-xs text-gray-700">A list of 5 latest checked in users including their name,
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
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked In</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="person in this.visitorLogs.data" :key="person.id">
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{
                                            person.visitor.email }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-4 pr-3 text-xs font-medium text-gray-900">
                                            {{ person.visitor.name }}</td>
                                        <td class="whitespace-nowrap text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(person.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mt-3">
            <TailwindPagination :data="visitorLogs" @pagination-change-page="getVisitorLogs" />
        </div>
        <div id="checkout" class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Checked Out</h1>
                    <p class="mt-2 text-xs text-gray-700">A list of 5 latest checked out users including their name,
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
                                            Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked Out</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="person in this.visitorCheckOuts.data" :key="person.id">
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-gray-500">{{
                                            person.visitor.email }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-xs font-medium text-gray-900 sm:pl-6">
                                            {{ person.visitor.name }}</td>
                                        <td class="whitespace-nowrap text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(person.updated_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mt-3">
            <TailwindPagination :data="visitorCheckOuts" @pagination-change-page="getCheckOuts" />
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
import moment from 'moment';
import { TailwindPagination } from 'laravel-vue-pagination';
import { userAuthStore } from "@/store/auth";
import DateFilter from '../Elements/DateFilter/DateFilter.vue';
export default {
    name: 'Dashboard',
    props: {
        data: {
            type: Object,
            default: {}
        }
    },
    components: {
    moment, TailwindPagination, DateFilter
    },
    data() {
        return {
            data: {},
            visitors: {},
            visitorLogs: [],
            visitorData: {},
            visitorCheckOuts: {},
            accountsCheckIn: {},
            numVisitors: '',
            numLogs: '',
            numCheckouts: '',
            filterOn: '',
            filterBefore: ''
        }
    },
    methods: {
        getVisitors() {
            if (userAuthStore().user.role_id == 2) {
                axios.get('/api/get-index-log-by-user-id?id=' + userAuthStore().user.id + '&filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitors = data.data.data;
                        this.numVisitors = this.visitors.total;
                    }).catch((e) => {

                    });
            }
            else {
                axios.get('/api/visitors/filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitors = data.data.data;
                        this.numVisitors = this.visitors.total;
                    }).catch((e) => {

                    });
            }
        },
        getVisitorLogs(page = 1) {
            if (userAuthStore().user.role_id == 2) {
                axios.get('/api/get-visitors-by-user?page=' + page + '&id=' + userAuthStore().user.id + '&filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitorLogs = data.data.data;
                        this.numLogs = this.visitorLogs.total;
                    }).catch((e) => {

                    });
            }
            else {
                axios.get('/api/visitor-logs?page=' + page + '&filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitorLogs = data.data.data;
                        this.numLogs = this.visitorLogs.total;
                    }).catch((e) => {

                    });
            }
        },
        getCheckOuts(page = 1) {
            if (userAuthStore().user.role_id == 2) {
                axios.get('/api/get-checkouts-by-user?page=' + page + '&id=' + userAuthStore().user.id + '&filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitorCheckOuts = data.data.data;
                        this.numCheckouts = this.visitorCheckOuts.total;
                    }).catch((e) => {

                    });
            }
            else {
                axios.get('/api/get-checkouts?page=' + page + '&filter1=' + this.filterOn + '&filter2=' + this.filterBefore)
                    .then((data) => {
                        this.visitorCheckOuts = data.data.data;
                        this.numCheckouts = this.visitorCheckOuts.total;
                    }).catch((e) => {

                    });
            }
        },

        filterData({ value1, value2 }) {
            this.filterOn = value1
            this.filterBefore = value2
            this.getVisitorLogs();
            this.getVisitors();
            this.getCheckOuts();
        }
    },
    created() {
        this.moment = moment;
        this.filterOn = moment().format('YYYY-MM-DD');
        this.filterBefore = moment().format('YYYY-MM-DD');
        this.getVisitorLogs();
        this.getVisitors();
        this.getCheckOuts();
    },
    beforeMount() {
        this.permissions = {
            view: userAuthStore().role.permissions.visitors.includes('view') ?? false,
            create: userAuthStore().role.permissions.visitors.includes('create') ?? false,
            update: userAuthStore().role.permissions.visitors.includes('update') ?? false
        }
    }
}

</script>