<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-extrabold leading-6 text-gray-900">Visit Types Table</h1>
            <p class="mt-2 text-xs text-gray-600">List of all User Visit Types</p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button @click.prevent="setOpen" type="button"
                class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Add
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
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm w-80 font-semibold text-center text-gray-900">
                                    Building Type</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm w-80 font-semibold text-center text-gray-900">
                                    Person to Visit</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm w-80 font-semibold text-center text-gray-900">
                                    Visit Approval</th>
                                <th scope="col" class="py-3.5 px-3 text-center text-sm font-semibold text-gray-900">Status
                                </th>
                                <th scope="col" class="py-3.5 px-3 text-sm font-semibold text-gray-900">Date Created</th>
                                <th scope="col" class="py-3.5 px-3 text-sm font-semibold text-gray-900">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in data.data" :key="item.id">
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-xs text-left w-5 font-bold text-gray-900 sm:pl-6">
                                    {{ item.name }}</td>
                                <td class="px-3 py-4 text-xs text-center w-96 break-all text-gray-500">{{ item.building_type_name.name }}</td>
                                <td class="px-3 py-4 text-xs text-center w-80 break-all text-gray-500">{{ 
                                    item.personToVisit ? "Enabled" : "Disabled" }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                    item.visitApproval ? 'Enabled' : 'Disabled' }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{ 
                                    item.status ? 'Active' : 'Inactive' }}</td>
                                <td class="px-3 py-4 text-xs text-center w-80 break-all text-gray-500">{{
                                    moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-xs font-medium sm:pr-6">
                                    <a @click.prevent="editVisitType(item)" href="#"
                                        class="flex justify-center text-slate-800 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                d="M7.84 1.804A1 1 0 018.82 1h2.36a1 1 0 01.98.804l.331 1.652a6.993 6.993 0 011.929 1.115l1.598-.54a1 1 0 011.186.447l1.18 2.044a1 1 0 01-.205 1.251l-1.267 1.113a7.047 7.047 0 010 2.228l1.267 1.113a1 1 0 01.206 1.25l-1.18 2.045a1 1 0 01-1.187.447l-1.598-.54a6.993 6.993 0 01-1.929 1.115l-.33 1.652a1 1 0 01-.98.804H8.82a1 1 0 01-.98-.804l-.331-1.652a6.993 6.993 0 01-1.929-1.115l-1.598.54a1 1 0 01-1.186-.447l-1.18-2.044a1 1 0 01.205-1.251l1.267-1.114a7.05 7.05 0 010-2.227L1.821 7.773a1 1 0 01-.206-1.25l1.18-2.045a1 1 0 011.187-.447l1.598.54A6.993 6.993 0 017.51 3.456l.33-1.652zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-end mt-3">
                    <TailwindPagination :data="data" @pagination-change-page="getData" />
                </div>
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Visit Type'"
        :description="'List of all User Visit Types'">
        <template v-slot:slider-body>
            <form @submit.prevent="editMode ? updateVisitType() : saveVisitType()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">
                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.name" label="Name" id="visitType"
                                :hasError="this.editMode ? false : form.errors.has('name')"
                                :errorMessage="this.editMode ? false : form.errors.get('name')"></NormalInput>
                        </div>
                        <div class="sm:col-span-3 mt-3">
                            <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Building
                                Type</label>
                            <v-select v-model="form.buildingType" placeholder="search" :options="building_types"
                                label="label"
                                :class="this.editMode ? ' ' : [form.errors.has('buildingType') ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : ' ']"></v-select>
                            <span v-show="this.editMode ? false : form.errors.has('buildingType')"
                                class="text-xs text-red-600 dark:text-red-500">{{ forMessage() }}</span>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="building"
                                :hasError="this.editMode ? false : form.errors.has('description')"
                                :errorMessage="this.editMode ? false : form.errors.get('description')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-8 flex justify-between">
                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Person to Visit</SwitchLabel>
                                </span>
                                <Switch v-model="form.personToVisit"
                                    :class="[form.personToVisit ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.personToVisit ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>

                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Visit Approval</SwitchLabel>
                                </span>
                                <Switch v-model="form.visitApproval"
                                    :class="[form.visitApproval ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.visitApproval ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
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
                                    :class="[form.status ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>

                            <SwitchGroup as="div" class="flex">
                                <span>
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900 mr-5" passive>
                                        Auto Approve</SwitchLabel>
                                </span>
                                <Switch v-model="form.autoApprove"
                                    :class="[form.autoApprove ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.autoApprove ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
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

export default {
    name: "VisitType",
    props: {
        data: {
            type: Array,
            default: {},
        },
    },
    components: {
        SliderVue, Switch, SwitchDescription, SwitchGroup, SwitchLabel, NormalInput, TailwindPagination
    },
    data() {
        return {
            data: {},
            editMode: false,
            open: false,
            form: new Form({
                name: '',
                buildingType: '',
                description: '',
                personToVisit: false,
                visitApproval: false,
                autoApprove: false,
                status: false,
            }),
            building_types: {},
            visitTypes: {}
        }
    },
    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({
                name: '',
                buildingType: '',
                description: '',
                personToVisit: false,
                visitApproval: false,
                autoApprove: false,
                status: false,
            })
        },
        saveVisitType() {
            this.form.buildingType = this.form.buildingType.value;

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
            this.form.buildingType = { value: item.building_type_name.id, label: item.building_type_name.name }
        },
        forMessage() {
            return this.editMode ? ' ' : this.form.errors.get('buildingType_id')
        },

        async getData(page = 1) {
            await axios.get('/api/visit-type?page=' + page).then((data) => {
                this.data = data.data.data;
                console.log(data.data);
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