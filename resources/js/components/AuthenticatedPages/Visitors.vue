<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">VISITORS</h1>
                    <p class="mt-2 text-xs text-gray-700">Log of all visitors in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Send
                        Invitation</button>
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
                                            class="w-56 px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Building</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Visit Type</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked In</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked Out</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in this.data.data" :key="item.id">
                                        <td class="text-left px-3 py-4 text-xs text-gray-900">{{ item.visitor.name }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.building.buildingName }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.visit_type.name }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.visitor.status ? 'Approved'
                                            : 'Pending Approval' }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ moment(item.visitor.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.isCheckedOut ? moment(item.visitor.updated_at).format('MMMM Do YYYY, h:mm:ss a') : "Not Yet" }}</td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs">
                                            <a @click.prevent="editVisitors(item)"
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
            <div class="flex items-center justify-center mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" />
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Visitors'"
        :description="'Log of all visitors in the database'">
        <template v-slot:slider-body>
            <form>
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sm:col-span-3 mt-3">
                            <label for="name" class="text-sm">Visitor Name</label>
                            <input v-model="form.name" disabled id="name" type="text"
                                class="mt-2 bg-gray-100 block w-full px-3 rounded-md border py-1.5 shadow-sm ring-gray-300 ring-1 ring-inset sm:text-sm sm:leading-6" />
                        </div>

                        <div class="sm:col-span-3 mt-2">
                            <div class="sm:col-span-3 mt-3">
                                <label for="building" class="text-sm">Visitor building</label>
                                <input v-model="form.building" disabled id="building" type="text"
                                    class="mt-2 bg-gray-100 block w-full px-3 rounded-md border py-1.5 shadow-sm ring-gray-300 ring-1 ring-inset sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3 mt-2">
                            <label for="visitType" class="text-sm">Visit Type</label>
                            <input v-model="form.visitType" disabled id="vvisitType" type="text"
                                class="mt-2 bg-gray-100 block w-full px-3 rounded-md border py-1.5 sm:text-sm ring-gray-300 ring-1 ring-inset   sm:leading-6" />
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status"
                                    :class="[form.status ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>
                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setOpen">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">{{
                            editMode
                            ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </template>
    </SliderVue>
</template>

<script>
import axios from 'axios';
import { Form } from 'vform';
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import moment from 'moment';

export default {
    name: 'VisitorLogs',
    props: {
        data: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            data: {},
            editMode: false,
            open: false,
            form: new Form({
                name: '',
                building: '',
                visitType: '',
                status: false,
            })
        }
    },

    components: {
        SliderVue, NormalInput, Switch, SwitchGroup, SwitchLabel
    },
    methods: {
        editVisitors(item) {
            this.editMode = true
            this.open = !this.open
            this.form = item;
            this.form.building = item.building.buildingName;
            console.log(this.form);
        },
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
        },
        async getData(page = 1) {
            await axios.get('/api/get-logs?page=' + page).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                // errorMessage('Opps!', e.message, 'top-right')
            });
        }
    },
    created() {
        this.getData()
        this.moment = moment;
    },
}

</script>