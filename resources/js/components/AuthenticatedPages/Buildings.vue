<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">BUILDINGS</h1>
                    <p class="mt-2 text-xs text-gray-700">Viewing and Adding types of Buildings</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex gap-1 items-center">
                    <div class="relative">
                        <input type="text" name="search"
                            class="h-[30px] border border-gray-500 rounded-md pl-2 text-xs w-80"
                            placeholder="Search: Building Name">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="absolute w-4 h-4 top-1.5 right-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <button @click.prevent="setOpen" type="button" v-if="permissions.create"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Add
                        Building</button>
                </div>

            </div>

            <div class="mt-3">
                <p class="text-sm">Showing
                    <select v-model="limitPage" @change="getData" name="length" class="text-center bg-white border-2">
                        <option selected value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    Entries
                </p>
            </div>

            <div class="mt-3 flow-root" v-if="permissions.view">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
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
                                        <td class="px-3 py-4 text-xs text-gray-900 ">{{ item.building_name }}
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs w-64 text-gray-500">{{ item.description }}
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.building_type ?
                                            item.building_type.name : 'HOA Condo'
                                        }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-900 flex space-x-1.5">
                                            <button :disabled="item.status ? false : true"
                                                @click.prevent="isOpen('Visitor', item)"
                                                :class="[item.status ? 'hover:bg-gray-300' : '', 'border border-gray-900 rounded-md py-1.5 px-3 w-full']">Visitor</button>
                                            <button :disabled="item.status ? false : true"
                                                @click.prevent="isOpen('Host', item)"
                                                :class="[item.status ? 'hover:bg-gray-300' : '', 'border border-gray-900 rounded-md py-1.5 px-3 w-full']">Host</button>
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.status == true ?
                                            'Active' : 'Inactive' }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs flex w-full justify-center items-center gap-2"
                                            v-if="permissions.update">
                                            <a @click.prevent="editBuilding(item)" href="#"
                                                class="flex justify-center text-slate-800 hover:text-blue-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>

                                            </a>

                                            <a @click.prevent="deleteBuilding(item)" href="#"
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
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between mt-3">
                <p class="text-sm">{{ 'Showing ' + this.data.from + ' to ' + this.data.to + ' of ' + this.data.total + ' entries.' }}</p>
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
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
                            <NormalInput v-model="form.building_name" label="Building Name" id="building"
                                :hasError="this.editMode ? false : form.errors.has('building_name')"
                                :errorMessage="this.editMode ? false : form.errors.get('building_name')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="description"
                                :hasError="this.editMode ? false : form.errors.has('description')"
                                :errorMessage="this.editMode ? false : form.errors.get('description')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="building" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                                <span v-show="form.errors && (form.errors.has('address') ?? false)" v-html="form.errors && (form.errors.has('address') ?? false) ? form.errors.get('address') : ''"
                                    class="text-[10px] text-red-600 dark:text-red-500 mt-1"></span>
                            </div>
                            <textarea v-model="form.address" type="text" name="build" id="building"
                                autocomplete="building"
                                class="block w-full h-40 px-3 rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" 
                                :class="form.errors && (form.errors.has('address') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''" />
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3 text-sm">
                            <div class="flex justify-between">
                                <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900">Choose
                                    Building Types</label>
                                <span v-show="form.errors && (form.errors.has('building_type') ?? false)" v-html="form.errors && (form.errors.has('building_type') ?? false) ? form.errors.get('building_type') : ''"
                                    class="text-[10px] text-red-600 dark:text-red-500"></span>
                            </div>
                            <v-select v-model="form.building_type" placeholder="search" :options="building_types"
                                label="label"
                                :class="form.errors && (form.errors.has('building_type') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <label for="build_logo" class="block text-sm font-medium leading-6 text-gray-900">{{ (editMode ?
                                'Edit' : 'Upload') + ' Logo' }}</label>
                            <div class="flex flex-col items-center justify-center mt-2">
                                <div class="flex justify-center mt-3">
                                    <div>
                                        <div class="flex items-center justify-center w-full">
                                            <label :style="{ 'background-image': `url(${image_url})` }"
                                                class="flex flex-col justify-center cursor-pointer w-52 h-52 border-4 border-dashed border-gray-400 hover:bg-gray-100 hover:border-gray-300 bg-center bg-cover bg-no-repeat">
                                                <div v-show="this.form.logo == null ? true : false"
                                                    class="flex flex-col items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-12 h-12 text-gray-600 group-hover:text-black"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <p
                                                        class="pt-1 text-sm tracking-wider text-black group-hover:text-black">
                                                        Select a photo</p>
                                                </div>
                                                <input type="file" ref="buildingLogo" class="opacity-0"
                                                    accept="image/png, image/jpeg, image/jpg, image/svg"
                                                    @input="uploadImage" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-sm mt-5 font-bold">Advance Settings</p>
                        
                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Delivery
                                        Health Declaration Form</SwitchLabel>
                                </span>
                                <Switch v-model="form.health_form"
                                    :class="[form.health_form ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.health_form ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>
                        <div class="sm:col-span-3 mt-2">
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
                        @click="setOpen(); this.getData()">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">{{
                            editMode
                            ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </template>
    </SliderVue>

    <DialogVue :isOpen="pop" :dialogTitle="mode + ' QR | ' + form.building_name" :modalWidth="'max-w-3xl'">
        <template v-slot:dialogBody>

            <div class="overflow-hidden shadow shadow-slate-400 sm:rounded-lg p-5 mt-4 flex-row md:flex-col">
                <div class="flex justify-center items-center flex-col p-10">
                    <div v-if="mode == 'Visitor'" class="flex lg:flex-row flex-col justify-center items-center gap-10">
                        <img :src="qrName(mode, form.qr_id)" class="mt-5 w-40 h-40" />

                        <h1 class="font-extrabold text-xl my-5 text-gray-900">OR</h1>
                        <a :href="this.url + '/visitor-registration/' + form.qr_id" target="_blank"
                            class="text-black bg-white w-36 h-8 border border-black hover:scale-105 duration-100 flex justify-center items-center rounded-md">
                            Go to Link
                        </a>
                    </div>

                    <div v-else class="flex lg:flex-row flex-col justify-center items-center gap-10 ">
                        <img :src="qrName(mode, form.qr_id)" class="mt-5 w-40 h-40" />
                        <h1 class="font-extrabold text-xl my-5 text-gray-900">OR</h1>
                        <a :href="this.url + '/homeowner-registration/' + form.qr_id" target="_blank"
                            class="text-black bg-white w-36 h-8 border border-black hover:scale-105 duration-100 flex justify-center items-center rounded-md">Go
                            to Link
                        </a>
                    </div>

                </div>


            </div>
            <div class="mt-4">
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-gray-800 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500"
                    @click.prevent="this.pop = !this.pop">
                    Close
                </button>
            </div>

        </template>
    </DialogVue>

    <DialogVue :isOpen="deletePrompt" :dialogTitle="'Delete?'" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>

            <div class="text-[16px] text-center my-10">
                <p>Are you sure you want to delete <span class="font-bold">{{ form.building_name }}</span>?</p>
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

import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import { createToast } from 'mosha-vue-toastify';
import moment from 'moment';
import axios from "axios";
import Form from "vform";
import { userAuthStore } from "@/store/auth";


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
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        moment,
        TailwindPagination,
    },

    data() {
        return {
            data: {},
            permissions: {},
            editMode: false,
            open: false,
            pop: false,
            mode: '',
            limitPage: '',
            form: new Form({
                building_name: '',
                address: '',
                description: '',
                building_type: '',
                logo: null,
                status: false,
                health_form: false,
                errors: []
            }),
            image_url: '',
            building_types: [],
            url: '',
            qr_url: 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=',
            deletePrompt: false
        }
    },

    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({});
            this.image_url = '';
        },

        isOpen(thisMode, item) {
            this.pop = !this.pop;
            this.mode = thisMode;
            this.form = item;
            this.hideLabel = false;
        },

        editBuilding(item) {
            console.log(item);
            this.editMode = true;
            this.open = !this.open;
            this.form = item;
            this.image_url = '/uploads/images/' + this.form.logo;
            this.form.building_type = { value: item.building_type.id, label: item.building_type.name }
        },

        deleteBuilding(item) {
            this.form = item;
            this.deletePrompt = !this.deletePrompt;
        },

        uploadImage() {
            let input = this.$refs.buildingLogo;
            let file = input.files;
            if (file && file[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image_url = e.target.result;
                    this.form.logo = e.target.result;
                };
                reader.readAsDataURL(file[0]);
                this.$emit("input", file[0]);
            }
        },

        saveBuilding() {
            this.$Progress.start();
            this.form.post('/api/building')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.hideLabel = false;
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
            this.form.building_type = this.form.building_type.value
            axios.put("/api/building/" + this.form.id, {
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
                this.$Progress.fail();
            })
        },

        async getData(page = 1) {
            await axios.get('/api/building?page=' + page + '&limit=' + this.limitPage).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                console.log(e.message)
            });
        },

        qrName(mode, uuid) {
            if (mode == 'Visitor')
                return this.qr_url + this.url + '/visitor-registration/' + uuid;
            else (mode == 'Host')
                return this.qr_url + this.url + '/homeowner-registration/' + uuid;
        },

        async getBuildingTypes() {
            await axios.get('/api/get-building-types').then((data) => {
                this.building_types = data.data.data
                console.log(this.building_types)
            }).catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
            });
        },
    },

    created() {
        this.getData();
        this.getBuildingTypes();
        this.moment = moment;
        this.url = new URL(window.location.href).origin
    },
    beforeMount() {
        this.permissions = {
            view: userAuthStore().role.permissions.buildings.includes('view') ?? false,
            create: userAuthStore().role.permissions.buildings.includes('create') ?? false,
            update: userAuthStore().role.permissions.buildings.includes('update') ?? false
        }
    }
}

</script>