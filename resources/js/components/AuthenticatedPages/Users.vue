<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">USERS</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name,
                        title, email and role.</p>
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
                                        <th scope="col"
                                            class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name</th>
                                        <th scope="col" class="text-left px-3 py-3.5  text-sm font-semibold text-gray-900">
                                            Email</th>
                                        <th scope="col" class="text-left px-3 py-3.5  text-sm font-semibold text-gray-900">
                                            Assigned Building</th>
                                        <th scope="col"
                                            class="text-center px-3 py-3.5  text-sm font-semibold text-gray-900">
                                            Verified</th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Status
                                        </th>
                                        <th scope="col" class="text-center py-3.5 pl-3 pr-4 sm:pr-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.id">
                                        <td class="w-80 py-4 pl-4 pr-3 text-xs font-600 text-gray-900 sm:pl-6">{{ item.name
                                        }}</td>
                                        <td class="w-72 break-all px-3 py-4 text-xs text-gray-500">{{ item.email }}
                                        </td>
                                        <td class="w-72 break-all px-3 py-4 text-xs text-gray-500">{{
                                            item.user_building.building.buildingName }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                            item.email_verified_at != null ? 'Yes' : 'No' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500"></td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-xs text-center font-medium sm:pr-6">
                                            <a @click.prevent="editUser(item)" href="#"
                                                class="flex justify-center text-slate-800 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
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
                    </div>
                </div>
            </div>

            <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'User'"
                :description="'A list of all the users in your account including their name, title, email and role.'">
                <template v-slot:slider-body>
                    <form @submit.prevent="editMode ? updateUser() : saveUser()">
                        <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                            <div class="my-4 grid grid-cols-1">
                                <div class="sm:col-span-3 mt-3">
                                    <NormalInput v-model="form.name" label="Name" id="user-name"
                                        :hasError="this.editMode ? false : form.errors.has('name')"
                                        :errorMessage="this.editMode ? false : form.errors.get('name')"></NormalInput>
                                </div>
                                <div class="sm:col-span-3 mt-3">
                                    <NormalInput v-model="form.email" label="Email" id="user-email"
                                        :hasError="this.editMode ? false : form.errors.has('email')"
                                        :errorMessage="this.editMode ? false : form.errors.get('email')">
                                    </NormalInput>
                                </div>
                                <div class="sm:col-span-3 mt-3 text-sm">
                                    <label for="email_subj"
                                        class="block text-sm font-medium leading-6 text-gray-900 mb-2">Choose
                                        Buildings</label>

                                    <v-select v-model="form.building" placeholder="search" :options="buildings"
                                        label="label"
                                        :class="form.errors.has('building') ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : ''"></v-select>
                                    <span v-show="form.errors.has('building')"
                                        class="text-xs/2 text-red-600 dark:text-red-500">{{ }}</span>
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
        </div>
    </div>
</template>
  
<script>

import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import { createToast } from 'mosha-vue-toastify';
import axios from "axios";
import Form from "vform";

export default {
    name: "Users",
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
                email: '',
                building: '',
            }),
            buildings: []
        }
    },
    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({
                id: '',
                name: '',
                email: '',
                building: '',
            })
        },
        saveUser() {
            this.$Progress.start();
            this.form.post('/api/user')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.form = new Form({
                        id: '',
                        name: '',
                        email: '',
                        building: '',
                    });
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
                        }
                    )
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },
        editUser(item) {
            this.editMode = true;
            this.open = !this.open;
            this.form.id = item.id;
            this.form.name = item.name;
            this.form.email = item.email;
            this.form.building = { value: item.user_building.building.id, label: item.user_building.building.buildingName };
        },
        updateUser() {
            axios.put("/api/user/" + this.form.id, {
                params: {
                    data: this.form
                }
            }).then((data) => {
                this.editMode = false;
                this.$Progress.finish();
                this.getData();
                this.form = new Form({
                    id: '',
                    name: '',
                    email: '',
                    building: '',
                });
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
                    }
                )
            }).catch((error) => {

            })
        },
        async getData() {
            await axios.get('/api/user').then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        },

        getBuildings() {
            axios.get('/api/get-buildings').then((data) => {
                this.buildings = data.data.data
            }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        },
    },
    created() {
        this.getData();
        this.getBuildings();
    }
}
</script>