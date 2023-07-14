<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-900">EXPECTED DELIVERIES</h1>
                    <p class="mt-2 text-xs text-gray-700">A catalog of all expected deliveries in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" @click.prevent="notif()"
                        class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Delivery
                        Notifications</button>
                </div>
            </div>


            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Company/Courier</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Building</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Expected Date</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.id">
                                        <td class="text-center px-3 py-4 text-xs text-gray-900">{{ item.courier_name }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.building.building_name }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ moment(item.target_date).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td
                                            class="relative text-center py-4 pl-3 pr-4 text-xs flex gap-1 items-center justify-center">
                                            <a class="approve text-white bg-green-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </a>
                                            <a class="reject text-white bg-yellow-500 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </a>
                                            <a class="approve text-white bg-red-400 rounded-md p-1 cursor-pointer">
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
            <div class="flex items-center justify-end mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
        <button type="button"
            class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 mt-3">Export
            CSV</button>
    </div>

    <DialogVue :isOpen="openNotif" :dialogTitle="'Delivery Notification'" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>
            <form @submit.prevent="saveDelivery">
            <div class="space-y-3">
                <div class="space-y-2">
                    <label for="courier_name">Courier / Company</label>
                    <input v-model="form.courier_name" type="text" class="pl-2 h-8 w-full border border-black focus:outline-none rounded-md">
                </div>

                <div class="space-y-2">
                    <label for="building">Building</label>
                    <v-select v-model="form.building_id" type="text" placeholder="Search" :options="buildings" label="label"
                        class="border border-black rounded-md"></v-select>
                </div>

                <div class="space-y-2">
                    <label for="date">Expected Delivery Date</label>
                    <input v-model="form.target_date" type="date" class="pl-2 h-8 w-full border border-black focus:outline-none rounded-md">
                </div>

                <div class="space-y-2">
                    <label for="date">Details (Optional)</label>
                    <textarea v-model="form.remarks" type="date" class="p-2 w-full border border-black focus:outline-none rounded-md"></textarea>
                </div>
            </div>

            <div class="mt-4 flex gap-1">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md border border-gray-800 py-2 px-5 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50">
                    Send
                </button>
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-blue-800 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90"
                    @click.prevent="this.openNotif = !this.openNotif">
                    Close
                </button>
            </div>
            </form>
        </template>
    </DialogVue>
</template>

<script>
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import { Form } from 'vform';
import axios from 'axios';
import moment from 'moment';
import { TailwindPagination } from 'laravel-vue-pagination';
import { userAuthStore } from "@/store/auth";

export default {

    components: {
        DialogVue,
        TailwindPagination,
        moment
    },

    props: {
        data: {
            type: Object,
            default: {}
        }
    },

    data() {
        return {
            data: {},
            buildings: [],
            openNotif: false,
            form: new Form({
                courier_name: '',
                building_id: '',
                user_id: '',
                remarks: '',
                target_date: '',
                status: true
            })
        }
    },

    methods: {
        notif() {
            this.openNotif = !this.openNotif;
            this.getBuildings();
        },

        saveDelivery() {
            this.form.building_id = this.form.building_id.value
            this.form.user_id = userAuthStore().user.id

            this.form.post('/api/expected-deliveries')
                .then((data) => {
                    this.openNotif = !this.openNotif
                    this.getData();
                }).catch((e) => {

                })
        },

        getBuildings() {
            axios.get('/api/get-buildings/')
                .then((data) => {
                    this.buildings = data.data.data
                }).catch((error) => {

                })
        },

        async getData(page = 1) {
            await axios.get('/api/expected-deliveries?page=' + page)
                .then((data) => {
                    this.data = data.data.data
                }).catch((e) => {

                })
        },
    },

    created() {
        this.getData();
        this.getBuildings();
        this.moment = moment;
    }
}

</script>