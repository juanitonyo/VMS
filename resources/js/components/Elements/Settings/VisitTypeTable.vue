<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-extrabold leading-6 text-blue-800">Visit Types Table</h1>
            <p class="mt-2 text-xs text-gray-600">List of all User Visit Types</p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex items-center gap-1">
            <div class="relative">
                <input type="text" name="search" class="py-2 border border-gray-500 rounded-md pl-2 text-xs w-80"
                    placeholder="Search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute w-4 h-4 top-2.5 right-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <button @click="setOpen" type="button"
                class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Add
                Entry</button>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Name
                                </th>
                                <th scope="col" class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Building Type</th>
                                <th scope="col" class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Person to Visit</th>
                                <th scope="col" class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Visit Approval</th>
                                <th scope="col" class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Status
                                </th>
                                <th scope="col" class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 ">
                                    Date Created</th>
                                <th scope="col" class="text-center py-4 px-4 text-sm font-semibold text-gray-900">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in data.data" :key="item.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs text-left w-5 font-bold text-gray-900 ">
                                    {{ item.name }}</td>
                                <td class="px-3 py-4 text-xs text-center w-64 break-all text-gray-500">{{
                                    item.building_type_name.name }}</td>
                                <td class="px-3 py-4 text-xs text-center break-all text-gray-500">{{
                                    item.person_to_visit ? "Enabled" : "Disabled" }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                    item.visit_approval ? 'Enabled' : 'Disabled' }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                    item.status ? 'Active' : 'Inactive' }}</td>
                                <td class="px-3 py-4 text-xs text-center w-80 break-all text-gray-500">{{
                                    moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}
                                </td>
                                <td
                                    class="flex items-center justify-center py-4 px-4 text-center text-xs font-medium w-full gap-2">
                                    <a @click.prevent="editVisitType(item)" href="#"
                                        class="flex justify-center text-slate-800 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <a @click.prevent="deleteVisitType(item)" href="#"
                                        class="flex justify-center text-slate-800 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>

                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-end mt-3">
                    <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
                </div>
            </div>
        </div>
    </div>

    <SliderVue :setOpen="this.open" :title="(editMode ? 'Update ' : 'Add ') + 'Visit Type'"
        :description="'List of all User Visit Types'">
        <template v-slot:slider-body>
            <form ref="thisForm" @submit.prevent="editMode ? updateVisitType() : saveVisitType()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">
                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.name" label="Visit Type Name" id="visitType"
                                :hasError="form.errors && (form.errors.has('name') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('name') ?? false) ? form.errors.get('name') : ''">
                            </NormalInput>
                        </div>
                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="building_type"
                                    class="block text-sm font-medium leading-6 text-gray-900">Building
                                    Type</label>
                                <span class="text-[10px] text-red-600 dark:text-red-500"
                                    v-show="form.errors && (form.errors.has('building_type') ?? false)"
                                    v-html="form.errors && (form.errors.has('building_type')) ? form.errors.get('building_type') : ''"></span>
                            </div>
                            <v-select v-model="form.building_type" placeholder="Search" :options="building_types"
                                label="label"
                                :class="form.errors && (form.errors.has('building_type') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="building"
                                :hasError="form.errors && (form.errors.has('description') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('description') ?? false) ? form.errors.get('description') : ''">
                            </NormalInput>
                        </div>

                        <p class="text-sm mt-5 font-bold">Advance Settings</p>

                        <div class="sm:col-span-3 mt-8 flex justify-between">
                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Person to Visit</SwitchLabel>
                                </span>
                                <Switch v-model="form.person_to_visit"
                                    :class="[form.person_to_visit ? 'bg-blue-800' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.person_to_visit ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>

                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Visit Approval</SwitchLabel>
                                </span>
                                <Switch v-model="form.visit_approval" :disabled="!form.person_to_visit"
                                    :class="[form.visit_approval ? 'bg-blue-800' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.visit_approval ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>

                        <div class="sm:col-span-3 mt-3 flex justify-between">
                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-[73.5px]"
                                        passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status"
                                    :class="[form.status ? 'bg-blue-800' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>

                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Auto Approve</SwitchLabel>
                                </span>
                                <Switch v-model="form.auto_approve"
                                    :class="[form.auto_approve ? 'bg-blue-800' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.auto_approve ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
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
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">{{
                            editMode
                            ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </template>
    </SliderVue>

    <DialogVue :isOpen="deletePrompt" :dialogTitle="'Delete?'" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>

            <div class="text-[16px] text-center my-10">
                <p>Are you sure you want to delete <span class="font-bold">{{ form.name }}</span>?</p>
            </div>

            <div class="mt-4 flex items-center justify-center gap-2">
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-red-500 py-2 px-5 text-sm font-semibold text-white">
                    Delete
                </button>
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-gray-900 py-2 px-5 text-sm font-semibold text-white"
                    @click.prevent="this.deletePrompt = !this.deletePrompt">
                    Close
                </button>
            </div>

        </template>
    </DialogVue>
</template>

<script>

import axios from "axios";
import Form from "vform";
import moment from 'moment';
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import { createToast } from 'mosha-vue-toastify';
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import NormalInput from "../Inputs/NormalInput.vue";
import { TailwindPagination } from 'laravel-vue-pagination';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'

export default {
    name: "VisitType",
    props: {
        data: {
            type: Object,
            default: {},
        },
    },
    components: {
        SliderVue, Switch, SwitchDescription, SwitchGroup, SwitchLabel, NormalInput, TailwindPagination, DialogVue
    },
    data() {
        return {
            data: {},
            building_types: [],
            editMode: false,
            open: false,
            visitTypes: {},
            form: new Form({
                name: '',
                building_type: '',
                description: '',
                person_to_visit: false,
                visit_approval: false,
                auto_approve: false,
                status: false,
            }),
            deletePrompt: false
        }
    },
    watch: {
        'form.person_to_visit': function (b) {
            if (!b) {
                this.form.visit_approval = false;
            }
        }
    },
    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.getbuildingType_ids();
            this.form = new Form({});
        },
        deleteVisitType(item) {
            this.form = item;
            this.deletePrompt = !this.deletePrompt;
        },
        saveVisitType() {
            this.$Progress.start();
            this.form.post('/api/visit-type')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.open = !this.open;
                    createToast({
                        title: 'Success!',
                        description: 'Data has been saved.'
                    },
                        {
                            position: 'top-left',
                            showIcon: 'true',
                            type: 'success',
                            toastBackgroundColor: '#00bcd4',
                            hideProgressBar: 'true',
                            toastBackgroundColor: '#00bcd4',
                        })
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },
        updateVisitType() {
            axios.put("/api/visit-type/" + this.form.id, {
                params: {
                    data: this.form
                }
            }).then((data) => {
                this.editMode = false;
                this.$Progress.finish();
                this.getData();
                this.form = new Form({});
                this.open = !this.open;
                createToast({
                    title: 'Success!',
                    description: 'Data has been updated.'
                },
                    {
                        position: 'top-left',
                        showIcon: 'true',
                        toastBackgroundColor: '#00bcd4',
                        type: 'success',
                        hideProgressBar: 'true',
                        toastBackgroundColor: '#00bcd4',
                    })
            }).catch((error) => {

            })
        },
        editVisitType(item) {
            this.editMode = true;
            this.open = !this.open;
            this.form = item;
            this.form.building_type = { value: item.building_type_name.id, label: item.building_type_name.name }
        },
        forMessage() {
            return this.editMode ? ' ' : this.form.errors.get('building_type')
        },

        async getData(page = 1) {
            await axios.get('/api/visit-type?page=' + page).then((data) => {
                this.data = data.data.data;
                console.log(this.data);
            }).catch((e) => {
                // errorMessage('Opps!', e.message, 'top-right')
            });
        },

        async getbuildingType_ids() {
            await axios.get('/api/get-building-types').then((data) => {
                this.building_types = data.data.data
            }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        },
    },
    created() {
        this.getData();
        this.getbuildingType_ids();
        this.moment = moment;
    }
}

</script>