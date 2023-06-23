<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">DELIVERIES</h1>
                    <p class="mt-2 text-xs text-gray-700">A catalog of all deliveries in the database</p>
                </div>

            </div>
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
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

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
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs">
                                            <a
                                                class="flex justify-center text-slate-800 hover:text-gray-500 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="flex items-center justify-center mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true"/>
            </div> -->
        </div>
    </div>

    <DialogVue :isOpen="pop" :dialogTitle="'Expected Deliveries'" :modalWidth="'max-w-6xl'">
        <template v-slot:dialogBody>
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
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Expected Date</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="text-center px-3 py-4 text-xs text-gray-900"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs flex gap-5 items-center justify-center">
                                            <a
                                                class="flex justify-center text-green-500 hover:text-green-500/90 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </a>
                                            <a class="flex justify-center text-red-500 hover:text-red-500/90 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <button type="button"
                    class="inline-flex md:w-40 w-full justify-center rounded-md bg-gray-800 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500"
                    @click.prevent="this.pop = !this.pop">
                    Close
                </button>
            </div>
        </template>
    </DialogVue>
</template>

<script>
import { TailwindPagination } from 'laravel-vue-pagination';
import axios from 'axios';
import moment from 'moment';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'

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
        DialogVue
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