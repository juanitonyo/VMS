<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">
                        USERS
                    </h1>
                    <p class="mt-2 text-xs text-gray-700">
                        A list of all the users in your account.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex sm:space-x-1 sm:space-y-0 space-y-1 space-x-0">
                    <span class="relative">
                        <button type="button" @click.prevent="openPending()"
                            class="block rounded-md bg-blue-800 hover:bg-blue-800/90 py-2 px-3 text-center text-sm font-semibold text-white ">
                            Pending Host
                        </button>
                        <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    </span>

                    <button @click.prevent="setOpen" type="button"
                        class="block rounded-md bg-blue-800 hover:bg-blue-800/90 py-2 px-3 text-center text-sm font-semibold text-white ">
                        Add User
                    </button>
                </div>
            </div>
            <div class="mt-3 flex items-center justify-between">
                <p class="text-xs">Showing
                    <select v-model="limitPage" @change="getData" name="length" class="text-center bg-white">
                        <option selected value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    Entries
                </p>

                <div class="relative">
                    <input v-model="this.search" type="text" name="search" @input="getData"
                        class="h-[30px] border border-gray-500 rounded-md pl-2 text-xs w-80"
                        placeholder="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="absolute w-4 h-4 top-2 right-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900 text">
                                            Name
                                        </th>
                                        <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Email
                                        </th>
                                        <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Assigned Building
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Verified
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Role
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Status
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Date Created
                                        </th>
                                        <th scope="col" class="text-center px-3 text-sm py-3.5 font-semibold">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in data.data" :key="item.id">
                                        <td class="w-64 py-4 pl-4 pr-3 text-xs font-600 text-gray-900 sm:pl-6">
                                            {{ item.name }}
                                        </td>
                                        <td class="w-[450px] break-all px-3 py-4 text-xs text-gray-500">
                                            {{ item.email }}
                                        </td>
                                        <td class="w-72 break-all px-3 py-4 text-xs text-gray-500">
                                            <span v-for="building in item.building" :key="building.id">
                                                <p>{{ building.building_name }}</p>
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">
                                            {{
                                                item.email_verified_at != null
                                                ? "Yes"
                                                : "No"
                                            }}
                                        </td>
                                        <td class="w-40 px-3 py-4 text-xs text-center text-gray-500">
                                            {{ item.role.title }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                            item.status == true ? 'Active' : 'Inactive' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500">{{
                                            moment(item.created_at).format('MM/DD/YYYY h:mm a') }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-3 text-xs text-center font-medium">
                                            <a @click.prevent="editUser(item)" href="#"
                                                class="flex justify-center text-slate-800 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
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
                <p class="text-xs">Showing {{ [this.data.from ?? false ? this.data.from : '0'] + ' to ' + [this.data.to ??
                    false ? this.data.to : '0'] + ' of ' + [this.data.total ?? false ? this.data.total : '0'] }} entries.
                </p>
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
        <a href="/api/export-user" target="_blank"
            class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 w-40 mt-3">Export
            CSV</a>
    </div>
    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'User'"
        :description="'A list of all the users in your account including their name, title, email and role.'">
        <template v-slot:slider-body>
            <form @submit.prevent="editMode ? updateUser() : saveUser()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border">
                    <div class="my-4 grid grid-cols-1">
                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.name" label="Name" id="name"
                                :hasError="form.errors && (form.errors.has('name') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('name') ?? false) ? form.errors.get('name') : ''">
                            </NormalInput>
                        </div>
                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.email" label="Email" id="user-email" :type="'email'"
                                :hasError="form.errors && (form.errors.has('email') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('email') ?? false) ? form.errors.get('email') : ''">
                            </NormalInput>
                        </div>
                        <div class="sliderPurpose sm:col-span-3 mt-3 text-sm">
                            <div class="flex justify-between">
                                <label for="select-roles"
                                    class="block text-sm font-medium leading-6 text-gray-900 mb-1">Choose Role</label>
                                <span class="text-[10px] text-red-600 dark:text-red-500 mt-1"
                                    v-show="form.errors && (form.errors.has('role_id') ?? false)"
                                    v-html="form.errors && (form.errors.has('role_id') ?? false) ? form.errors.get('role_id').replace(' id', '') : ''"></span>
                            </div>
                            <v-select v-model="form.role_id" :options="roles" label="label" placeholder="search"
                                :class="form.errors && (form.errors.has('role_id') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''"></v-select>
                        </div>
                        <div class="sliderPurpose sm:col-span-3 mt-3 text-sm">
                            <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900 mb-1">Choose
                                Buildings</label>

                            <v-select v-model="form.building" :options="buildings" label="label" placeholder="search"
                                :class="form.errors && (form.errors.has('building') ?? false) ? 'bg-red-50  border-red-500 text-red-900 placeholder-red-700' : ''"></v-select>
                            <span class="text-xs/2 text-red-600 dark:text-red-500"
                                v-show="form.errors && (form.errors.has('building') ?? false)"
                                v-html="form.errors && (form.errors.has('building') ?? false) ? form.errors.get('building') : ''"></span>
                        </div>
                        <div class="sm:col-span-3 mt-3" :class="editMode ? '' : 'hidden'">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status" :class="[
                                    form.status
                                        ? 'bg-blue-800'
                                        : 'bg-gray-200',
                                    'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2',
                                ]">
                                    <span aria-hidden="true" :class="[
                                        form.status
                                            ? 'translate-x-5'
                                            : 'translate-x-0',
                                        'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                    ]"></span>
                                </Switch>
                            </SwitchGroup>
                        </div>
                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setOpen">
                        Cancel
                    </button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-blue-800 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90">
                        {{ editMode ? "Update" : "Save" }}
                    </button>
                </div>
            </form>
        </template>
    </SliderVue>

    <!-- Pending Host Button -->
    <DialogVue :isOpen="pendingHost" :dialogTitle="'Pending Host'" :modalWidth="'max-w-5xl'">
        <template v-slot:dialogBody>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50 font-poppins">
                                    <tr>
                                        <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Name
                                        </th>
                                        <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Assigned Building
                                        </th>
                                        <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Location
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">
                                            Created At
                                        </th>
                                        <th scope="col" class="text-center px-3 py-3.5">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="w-64 py-4 pl-4 pr-3 text-xs font-600 text-gray-900 sm:pl-6"></td>
                                        <td class="w-64 break-all px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="w-64 break-all px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="w-64 break-all px-3 py-4 text-xs text-gray-500"></td>
                                        <td
                                            class="flex items-center justify-center gap-1 whitespace-nowrap py-4 pl-3 pr-4 text-xs text-center font-medium sm:pr-6">
                                            <a @click.prevent="setShow('Approval')"
                                                class="approve text-white bg-green-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </a>
                                            <a @click.prevent="setShow('Disapproval')"
                                                class="disapprove text-white bg-red-400 rounded-md p-1 cursor-pointer">
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

            <div class="mt-4 w-full flex justify-end">
                <button type="button" class="w-40 rounded-md bg-blue-800 py-2 px-5 text-sm font-semibold text-white"
                    @click.prevent="this.pendingHost = !this.pendingHost">
                    Close
                </button>
            </div>

        </template>
    </DialogVue>

    <!-- Add Entry Button -->
    <DialogVue :isOpen="show" :dialogTitle="'Reason for ' + statusChoice" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>

            <p class="text-xs mb-1">Please state your reason:</p>
            <textarea name="reason" id="reason" class="w-full h-36 rounded-md focus:outline-none border p-2 text-sm" />

            <div class="mt-4 flex gap-1">
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md border border-gray-800 py-2 px-5 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50">
                    {{ statusChoice == 'Approval' || statusChoice == 'Disapproval' ? statusChoice == 'Approval' ? 'Approve'
                        : 'Disapprove' : statusChoice }}
                </button>
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-gray-800 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800/90"
                    @click.prevent="this.show = !this.show">
                    Close
                </button>
            </div>

        </template>
    </DialogVue>
</template>

<script>
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";
import { TailwindPagination } from 'laravel-vue-pagination';
import NormalInput from "@/components/Elements/Inputs/NormalInput.vue";
import SliderVue from "@/components/Elements/Modals/Slider.vue";
import { createToast } from "mosha-vue-toastify";
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import axios from "axios";
import Form from "vform";
import moment from 'moment';

export default {
    name: "Users",
    props: {
        data: {
            type: Object,
            default: {}
        }
    },
    components: {
        SliderVue,
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        NormalInput,
        DialogVue,
        TailwindPagination,
        moment
    },
    data() {
        return {
            data: {},
            limitPage: 10,
            search: '',
            editMode: false,
            open: false,
            form: new Form({
                id: '',
                name: '',
                email: '',
                role_id: '',
                building: '',
                password: '',
                status: true,
            }),
            errors: {
                role_id: { error: false, label: '' },
                building: { error: false, label: '' },
            },
            roles: {},
            buildings: {},
            pendingHost: false,
            exisitingData: {},
            statusChoice: '',
            isFormComplete: false,
            show: false,
            size: '',
            search: ''
        };
    },
    methods: {

        // Opening and Closing of Dialog Vue Component
        setShow(choice) {
            this.statusChoice = choice;
            this.show = !this.show
        },

        // Opening and Closing of Slider Vue Component
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({});
        },

        validateform() {
            if (this.form.role_id == '') {
                this.errors.role_id.error = true;
                this.errors.role_id.label = 'The role field is required.'
            }
            else {
                this.errors.role_id.error = false;
            }
            if (this.form.building == '') {
                this.errors.building.error = true;
                this.errors.building.label = 'The building field is required.'
            }
            else {
                this.errors.building.error = false;
            }
            if (this.errors.role_id.error || this.errors.building.error) {
                this.isFormComplete = false;
            }
            else {
                this.isFormComplete = true;
            }
        },

        saveUser() {
            console.log(this.form)
            this.$Progress.start();
            this.form
                .post("/api/user")
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.form = new Form({});
                    this.open = !this.open;
                    createToast(
                        {
                            title: "Account has been added successfully!",
                            description: "Login details are sent via mail.",
                        },
                        {
                            position: "top-left",
                            showIcon: "true",
                            type: "success",
                            toastBackgroundColor: "#00bcd4",
                            hideProgressBar: "true",
                            toastBackgroundColor: "#00bcd4",
                        }
                    );
                })
                .catch((error) => {
                    this.$Progress.fail();
                });
        },

        openPending() {
            this.pendingHost = !this.pendingHost;
        },

        editUser(item) {
            this.editMode = true;
            this.open = !this.open;
            this.form = item;
            this.form.role_id = { value: item.role.id, label: item.role.title }
            console.log(this.form)
            // this.form.building = { value: item.user_building.building.id, label: item.user_building.building.building_name }
        },
        updateUser() {
            this.form.role_id = this.form.role_id.value
            this.form.building = this.form.building.value

            axios.put("/api/user/" + this.form.id, {
                    params: {
                        data: this.form,
                    },
                })
                .then((data) => {
                    this.editMode = false;
                    this.$Progress.finish();
                    this.getData();
                    this.this.form = new Form({});;
                    this.open = !this.open;
                    createToast(
                        {
                            title: "Success!",
                            description: "Data has been updated.",
                        },
                        {
                            position: "top-left",
                            showIcon: "true",
                            type: "success",
                            toastBackgroundColor: "#00bcd4",
                            hideProgressBar: "true",
                            toastBackgroundColor: "#00bcd4",
                        }
                    );
                })
                .catch((error) => { });
        },
        async getData(page = 1) {
            await axios.get("/api/user?page=" + page + "&limit=" + this.limitPage + '&search=' + this.search).then((data) => {
                this.data = data.data.data;
                this.size = data.data.data.per_page;
            })
                .catch((e) => {
                    errorMessage("Opps!", e.message, "top-right");
                });
        },

        getRoles() {
            axios.get("/api/get-roles")
                .then((data) => {
                    this.roles = data.data.data;
                })
                .catch((e) => {
                    errorMessage("Opps!", e.message, "top-right");
                });
        },

        getBuildings() {
            axios.get("/api/get-buildings")
                .then((data) => {
                    this.buildings = data.data.data;
                })
                .catch((e) => {
                    errorMessage("Opps!", e.message, "top-right");
                });
        },
    },
    created() {
        this.getData();
        this.getRoles();
        this.getBuildings();
        this.moment = moment;
    },
};
</script>
