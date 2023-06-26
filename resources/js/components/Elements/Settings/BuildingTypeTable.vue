<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-extrabold leading-6 text-gray-900">Building Type Table</h1>
            <p class="mt-2 text-xs text-gray-700 w-[400px]">A roster of all building types associated with your account,
                including
                their category, description and location.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex items-center gap-1">
            <div class="relative">
                <input type="text" name="search" class="h-[30px] border border-gray-500 rounded-md pl-2 text-xs w-80"
                    placeholder="Search: Building Type">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute w-4 h-4 top-1.5 right-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <button @click.prevent="setOpen" type="button"
                class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800">Add
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
                                <th scope="col"
                                    class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6">Building
                                    Type</th>
                                <th scope="col" class="text-left px-3 py-3.5  text-sm font-semibold text-gray-900">
                                    Description</th>
                                <th scope="col" class="text-center px-3 py-3.5  text-sm font-semibold text-gray-900">
                                    Delivery Form</th>
                                <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">Status
                                </th>
                                <th scope="col" class="text-center py-3.5 pl-3 pr-4 text-sm font-semibold text-gray-900">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in data.data" :key="item.id">
                                <td class="w-80 py-4 pl-4 pr-3 text-xs font-600 text-gray-900 sm:pl-6">{{ item.name }}</td>
                                <td class="w-72 break-all px-3 py-4 text-xs text-gray-500">{{ item.description }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                    item.delivery_form == true ? 'Active' : 'Inactive' }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{ item.status ==
                                    true ? 'Active' : 'Inactive' }}</td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-xs text-center font-medium sm:pr-6">
                                    <a @click.prevent="editBuilding(item)" href="#"
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
                <div class="flex items-center justify-between mt-3">
                    <button type="button"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800">Export
                        CSV</button>
                    <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
                </div>
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Building Type'"
        :description="'A roster of all building types associated with your account, including their category, description and location.'">
        <template v-slot:slider-body>
            <form @submit.prevent="editMode ? updateBuilding() : saveBuilding()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.name" label="Building Type" id="building-name"
                                :hasError="this.editMode ? false : form.errors.has('name')"
                                :errorMessage="this.editMode ? false : form.errors.get('name')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="building-name"
                                :hasError="this.editMode ? false : form.errors.has('description')"
                                :errorMessage="this.editMode ? false : form.errors.get('description')"></NormalInput>
                        </div>

                        <p class="text-sm mt-5 font-bold">Advance Settings</p>

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>Add
                                        Delivery Service Form</SwitchLabel>
                                </span>
                                <Switch v-model="form.delivery_form"
                                    :class="[form.delivery_form ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.delivery_form ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model.lazy="form.status"
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
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import { createToast } from 'mosha-vue-toastify';
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import NormalInput from "../Inputs/NormalInput.vue";

export default {
    name: "BuildingTypeTable",
    props: {
        data: {
            type: Array,
            default: {},
        }
    },
    components: {
        SliderVue, Switch, SwitchDescription, SwitchGroup, SwitchLabel, NormalInput,
    },
    data() {
        return {
            data: {},
            editMode: false,
            open: false,
            form: new Form({
                id: '',
                name: '',
                description: '',
                delivery_form: false,
                status: false,
            }),
        }
    },
    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({})
        },
        saveBuilding() {
            this.$Progress.start();
            this.form.post('/api/building-types/')
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
        editBuilding(item) {
            this.editMode = true;
            this.open = !this.open;
            this.form = item;
        },
        updateBuilding() {
            axios.put("/api/building-types/" + this.form.id, {
                params: {
                    data: this.form
                }
            }).then((data) => {
                this.editMode = false;
                this.$Progress.finish();
                this.getData();
                this.form = new Form({})
                this.open = !this.open;
                createToast({
                    title: 'Success!',
                    description: 'Data has been updated.'
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

            })
        },
        async getData(page = 1) {
            await axios.get('/api/building-types?page=' + page).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                // errorMessage('Opps!', e.message, 'top-right')
            });
        }
    },
    created() {
        this.getData();
    }


}

</script>
