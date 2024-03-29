<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-cyan-600">BUILDINGS</h1>
                    <p class="mt-2 text-xs text-gray-700">Viewing and Adding types of Buildings</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button @click.prevent="setOpen" type="button"
                        class="block rounded-md bg-cyan-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Add
                        Building</button>
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
                                            class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 sm:pl-6">
                                            Building Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Description</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Building Type</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            QR Code</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Date Created</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.id">
                                        <td class="text-center px-3 py-4 text-xs text-gray-900 ">{{ item.buildingName }}
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.description }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.building_type.name
                                        }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">
                                            <button @click.prevent="isOpen('Visitor', item)"
                                                class="border border-cyan-500 rounded-md py-1.5 px-3 mx-1 hover:bg-cyan-500 hover:text-white">Visitor</button>
                                            <button @click.prevent="isOpen('Host', item)"
                                                class="border border-cyan-500 rounded-md py-1.5 px-4 hover:bg-cyan-500 hover:text-white">Host</button>
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.status == true ?
                                            'Active' : 'Inactive' }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs">
                                            <a @click.prevent="editBuilding(item)" href="#"
                                                class="text-cyan-600 hover:text-cyan-900">Edit<span
                                                    class="sr-only"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" />
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Building'"
        :description="'Viewing and Adding types of Buildings'">
        <template v-slot:slider-body>
            <form @submit.prevent="editMode ? updateBuilding() : saveBuilding()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.buildingName" label="Building Type Name" id="building"
                                :hasError="this.editMode ? false : form.errors.has('buildingName')"
                                :errorMessage="this.editMode ? false : form.errors.get('buildingName')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="building"
                                :hasError="this.editMode ? false : form.errors.has('description')"
                                :errorMessage="this.editMode ? false : form.errors.get('description')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <label for="building" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                            <div class="mt-2">
                                <textarea v-model="form.address" type="text" name="build" id="building"
                                    autocomplete="building  "
                                    class="block w-full h-40 px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>

                        <div class="sm:col-span-3 mt-3 text-sm">
                            <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900 mb-2">Choose
                                Building Type</label>
                            <!-- <VueMultiselect
                                v-model="form.buildingType"
                                :options="option"
                                :close-on-select="true"
                                :clear-on-select="false"
                            /> -->
                            <v-select v-model="form.buildingType" placeholder="search" :options="building_types"
                                label="label"></v-select>
                        </div>
                        <!-- <div class="sm:col-span-3 mt-3">    
                            <DropDown v-model="form.buildingType" label="Building Type" id="building" :options="option" :hasError=" this.editMode ? false: form.errors.has('buildingType')" :errorMessage="this.editMode ? false: form.errors.get('buildingType ')"></DropDown>
                        </div> -->

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status"
                                    :class="[form.status ? 'bg-cyan-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <label for="build_logo" class="block text-sm font-medium leading-6 text-gray-900">Upload
                                Logo</label>
                            <div class="flex flex-col items-center justify-center mt-2">
                                <div
                                    class="flex flex-col items-center justify-center content-none border h-32 w-32 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xs m-2">Upload Logo</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setOpen">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-cyan-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500">{{
                            editMode
                            ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </template>
    </SliderVue>

    <DialogVue :isOpen="pop" :dialogTitle="vMode + ' QR | ' + form.buildingName">
        <template v-slot:dialogBody>

            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg p-5 mt-4">
                <div class="flex justify-center items-center flex-col">
                    <img :src="qrName(form.qr_id)" class="mt-5 bg-cyan-400" />
                    <h1 class="font-extrabold text-2xl my-5 text-cyan-700">OR</h1>
                    <a :href="this.proxyURL + this.route + form.qr_id" class="text-cyan-500 hover:text-cyan-600 underline">{{ this.proxyURL + this.route + form.qr_id
                    }}</a>
                </div>
            </div>

            <div class="mt-4">
                <button type="button"
                    class="inline-flex justify-center rounded-md bg-cyan-600 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500"
                    @click.prevent="this.pop = !this.pop">
                    Close
                </button>
            </div>
            
        </template>
    </DialogVue>
</template>

<script>

import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
// import DropDown from '@/components/Elements/Inputs/DropDown.vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import { createToast } from 'mosha-vue-toastify';
import VueMultiselect from 'vue-multiselect';
import moment from 'moment';
import axios from "axios";
import Form from "vform";


export default {

    name: 'Building',
    props: {
        data: {
            type: Array,
            default: {}
        },
    },

    components: {
        SliderVue,
        DialogVue,
        NormalInput,
        //DropDown,
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        moment,
        TailwindPagination,
        VueMultiselect
    },

    data() {
        return {
            data: {},
            editMode: false,
            open: false,
            pop: false,
            vMode: '',
            form: new Form({
                buildingName: '',
                address: '',
                description: '',
                buildingType: '',
                status: false,
            }),

            building_types: [],

            url: 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=',
            route: '/visitor-registration/',
            proxyURL: import.meta.env.VITE_APP_URL
        }
    },

    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({
                buildingName: '',
                address: '',
                description: '',
                buildingType: '',
                status: false,
            })
        },

        isOpen(mode, item) {
            this.pop = !this.pop;
            this.vMode = mode;
            this.form = item;
        },

        editBuilding(item) {
            this.editMode = true;
            this.open = !this.open;
             this.form = item;
            this.form.buildingType = {value : item.building_type.id , label: item.building_type.name}
        },

        saveBuilding() {
            this.$Progress.start();
            this.form.post('/api/building')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.form = new Form({
                        buildingName: '',
                        address: '',
                        description: '',
                        buildingType: '',
                        status: false,
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
                        })
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },

        updateBuilding() {
            axios.put("/api/building/" + this.form.id, {
                params: {
                    data: this.form
                }
            }).then((data) => {
                this.editMode = false;
                this.$Progress.finish();
                this.getData();
                this.form = new Form({
                    buildingName: '',
                    address: '',
                    description: '',
                    buildingType: '',
                    status: false,
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
                    })
            }).catch((error) => {

            })
        },
        async getData(page = 1) {
            await axios.get('/api/building?page=' + page).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        },

        qrName(uuid) {
            return this.url + this.proxyURL + this.route + uuid;
        },

        getBuildingTypes() {
            axios.get('/api/get-building-types').then((data) => { this.building_types = data.data.data; console.log(this.building_types) }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        }
    },
    created() {
        this.getData();
        this.getBuildingTypes();
        this.moment = moment;
    }
}

</script>