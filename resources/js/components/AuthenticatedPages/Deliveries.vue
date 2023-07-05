<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">DELIVERIES</h1>
                    <p class="mt-2 text-xs text-gray-700">A catalog of all deliveries in the database</p>
                </div>

            </div>
            <DateFilter class="mt-5" :isHidden="'hidden'"></DateFilter>
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
                                            moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between mt-3">
                <button type="button"
                    class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90">Export
                    CSV</button>
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
    </div>
</template>

<script>
import { TailwindPagination } from 'laravel-vue-pagination';
import axios from 'axios';
import moment from 'moment';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import DateFilter from '../Elements/DateFilter/DateFilter.vue';

export default {

    name: 'Delivery',
    props: {
        data: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            data: {},
            pop: false
        }
    },
    components: {
        moment,
        TailwindPagination,
        DialogVue,
        DateFilter
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