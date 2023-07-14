<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">DELIVERIES</h1>
                    <p class="mt-2 text-xs text-gray-700">A catalog of all deliveries in the database</p>
                </div>

                <div class="relative">
                    <input
                        class="h-[30px] border border-gray-500 rounded-md pl-2 text-xs w-80" placeholder="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="absolute w-4 h-4 top-2 right-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
            <DateFilter class="mt-5"></DateFilter>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="w-56 px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Rider Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Mobile</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Company</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Building/s</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Date Created</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.id">
                                        <td class="text-center px-3 py-4 text-xs text-gray-900">{{ item.rider_name }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.contact }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.courier_name }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">Test</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(item.created_at).format('MM/DD/YYYY h:mm a') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
        <button type="button"
            class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 mt-3">Export
            CSV</button>
    </div>
</template>

<script>
import { TailwindPagination } from 'laravel-vue-pagination';
import { Form } from 'vform';
import axios from 'axios';
import moment from 'moment';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import DateFilter from '../Elements/DateFilter/DateFilter.vue';

export default {

    name: 'Delivery',
    components: {
        moment,
        TailwindPagination,
        DialogVue,
        DateFilter
    },
    props: {
        data: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            data: {},
            pop: false,
            form: new Form({
                courier_name: '',
                rider_name: '',
                contact: ''
            }),
        }
    },

    methods: {
        async getData() {
            await axios.get('/api/delivery/')
                .then((data) => {
                    this.data = data.data.data;
                }).catch((e) => {
                    this.$Progress.fail();
                });
        },

        setPop() {
            this.pop = !this.pop;
        },
    },

    created() {
        this.getData();
        this.moment = moment;
    }
}
</script>