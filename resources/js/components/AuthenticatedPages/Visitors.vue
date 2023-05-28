<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">VISITORS</h1>
                    <p class="mt-2 text-xs text-gray-700">Log of all visitors in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none" v-if="permissions.create">
                    <button type="button" @click.prevent="setPop()"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Send
                        Invitation</button>
                </div>

            </div>
            <div class="mt-8 flow-root" v-if="permissions.view">
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
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.building.buildingName
                                        }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.visit_type.name }}
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.visitor.status ?
                                            'Approved'
                                            : 'Pending Approval' }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{
                                            moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500">{{ item.isCheckedOut ?
                                            moment(item.updated_at).format('MMMM Do YYYY, h:mm:ss a') : "Not Yet" }}
                                        </td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs" v-if="permissions.update">
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

    <SliderVue :setOpen="open" :title="(editMode ? 'View ' : 'Add ') + 'Visitors'"
        :description="'A visitor in the database'">
        <template v-slot:slider-body>
            <div class="relative flex-1 py-2 sm:px-4 space-y-5">

                <div class="flex items-center justify-center mt-6">
                    <img :src="this.account.visitor.profilePhoto != '' ? '/uploads/profiles/' + this.account.visitor.profilePhoto : ''"
                        class="relative w-[100px] h-[100px] border border-black rounded-full">
                    <svg v-show="this.account.visitor.profilePhoto == '' ? true : false" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                </div>
                <p class="italic text-xs text-center">Visitor Details</p>
                <div class="my-3 mx-5 grid grid-cols-1">
                    <div class="grid grid-cols-2 text-xs">
                        <div class="col-span-1 font-bold text-gray-800">
                            <p>Name of Visitor:</p>
                            <p>Type of Registration:</p>
                            <p>Location:</p>
                            <p>Identification:</p>
                            <p>Person To Visit:</p>
                            <p>Person To Visit Email:</p>
                            <p>Reference Code:</p>
                            <p>Building:</p>
                            <p>Type of Visit:</p>
                            <p>Checked in at:</p>
                            <p>Checked in by:</p>
                            <p>Checked out at:</p>
                            <p>Checked out by:</p>
                            <p>Approved by:</p>
                            <p>Rating:</p>
                            <p>No. of visits in this building:</p>
                            <p>Remarks:</p>
                            <p>Health Form:</p>
                            <p>Temperature:</p>
                        </div>
                        <div class="col-span-1 justify-self-end italic text-right text-gray-500">
                            <p>{{ this.account.visitor.name }}</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>{{ this.account.visitor.validId }}</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>{{ this.account.visitor.refCode }}</p>
                            <p>{{ this.account.building.buildingName }}</p>
                            <p>{{ this.account.visit_type.name }}</p>
                            <p>{{ moment(this.account.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                        </div>
                    </div>
                    <form>
                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="this.status"
                                    :class="[this.status ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[this.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                <button type="button"
                    class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                    @click="setOpen">Cancel</button>
                <button type="submit" @click.prevent="updateVisitor()"
                    :class="[this.isChanged ? 'hover:bg-gray-500' : '', 'focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500 ml-4 inline-flex justify-center rounded-md bg-gray-600 py-2 px-3 text-sm font-semibold text-white shadow-sm']">
                    Save</button>
            </div>
        </template>
    </SliderVue>

    <SliderVue :setOpen="pop" :title="'Send Invitation'" :description="'Invite someone to your location'">
        <template v-slot:slider-body>
            <form>
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput label="Email" id="email"
                                :hasError="this.editMode ? false : form.errors.has('email')"
                                :errorMessage="this.editMode ? false : form.errors.get('email')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput label="First Name" id="fname"
                                :hasError="this.editMode ? false : form.errors.has('fname')"
                                :errorMessage="this.editMode ? false : form.errors.get('fname')"></NormalInput>
                        </div>


                        <div class="sm:col-span-3 mt-3">
                            <NormalInput label="Last Name" id="lname"
                                :hasError="this.editMode ? false : form.errors.has('lname')"
                                :errorMessage="this.editMode ? false : form.errors.get('lname')"></NormalInput>
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="building"
                                    class="block text-sm font-medium leading-6 text-gray-900">Building</label>
                                <span v-show="this.editMode ? false : form.errors.has('building')"
                                    class="text-[10px] text-red-600 dark:text-red-500">{{ forBuilding() }}</span>
                            </div>
                            <v-select placeholder="Search" :options="building" label="label"
                                :class="this.editMode ? ' ' : [form.errors.has('building') ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700' : ' ']"></v-select>
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="visitType" class="block text-sm font-medium leading-6 text-gray-900">Purpose of Visit</label>
                                <span v-show="this.editMode ? false : form.errors.has('visitType')"
                                    class="text-[10px] text-red-600 dark:text-red-500">{{ forVisitType() }}</span>
                            </div>
                            <v-select placeholder="Search" :options="visitType" label="label"
                                :class="this.editMode ? ' ' : [form.errors.has('visitType') ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700' : ' ']"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput label="Location" id="location"
                                :hasError="this.editMode ? false : form.errors.has('location')"
                                :errorMessage="this.editMode ? false : form.errors.get('location')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput label="Contact" id="contact"
                                :hasError="this.editMode ? false : form.errors.has('contact')"
                                :errorMessage="this.editMode ? false : form.errors.get('contact')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Companion/s</label>
                                <div class="text-[10px] text-red-600 dark:text-red-500 mt-1"
                                    v-if="form.errors.has('companion')" v-html="form.errors.get('companion')" />
                            </div>
                            <textarea
                                :class="this.editMode ? ' ' : [form.errors.has('companion') ? 'border-red-500 bg-red-50' : 'border border-gray-300 bg-white', 'focus:outline-none p-2 text-xs resize-none w-full h-20 rounded-md border border-gray-300']"></textarea>
                                <p class="text-gray-500 text-[10px] text-left italic font-light">Note: Please type the name/s of the companion. If multiple names, seperate each with a comma ( , ).</p>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <!-- <NormalInput label="Target Date / Time" id="dateTime"
                                :hasError="this.editMode ? false : form.errors.has('dateTime')"
                                :errorMessage="this.editMode ? false : form.errors.get('dateTime')"></NormalInput> -->
                            <div class="flex justify-between">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Target Date</label>
                                <div class="text-[10px] text-red-600 dark:text-red-500 mt-1"
                                    v-if="form.errors.has('date')" v-html="form.errors.get('date')" />
                            </div>
                            <input type="date" :class="this.editMode ? ' ' : [form.errors.has('date') ? 'border-red-500 bg-red-50' : 'border border-gray-300 bg-white', 'focus:outline-none px-3 py-2 text-xs w-full rounded-md border border-gray-300']" />
                        </div>


                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setOpen">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Send</button>
                </div>
            </form>
        </template>
    </SliderVue>
</template>

<script>
import axios from 'axios';
import { userAuthStore } from "@/store/auth";
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import moment from 'moment';
import Form from 'vform';

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
            permissions: {},
            data: {},
            editMode: false,
            open: false,
            pop: false,
            status: false,
            isChanged: false,
            account: {},
            form: new Form({
                email: '',
                fname: '',
                lname: '',
                building: '',
                visitType: '',
                location: '',
                contact: '',
                companion: '',
                date: ''
            }),
            visitType: [],
            building: []
        }
    },

    components: {
        SliderVue, NormalInput, Switch, SwitchGroup, SwitchLabel
    },
    methods: {
        editVisitors(item) {
            this.editMode = true
            this.open = !this.open
            this.account = item
            this.status = this.account.visitor.status
        },
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.status = false;
        },
        setPop() {
            this.pop = !this.pop;
        },
        async getData(page = 1) {
            await axios.get('/api/get-logs?page=' + page).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                // errorMessage('Opps!', e.message, 'top-right')
            });
        },
        saveInvitation() {
            this.form.post('/api/')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.pop = !this.pop;
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

        updateVisitor() {
            this.account.visitor.status = this.status
            axios.put("/api/visitors/" + this.account.visitor.id, {
                params: {
                    data: this.account.visitor
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
                        type: 'success',
                        toastBackgroundColor: '#00bcd4',
                        hideProgressBar: 'true',
                        toastBackgroundColor: '#00bcd4',
                    })
            }).catch((error) => {
                this.$Progress.fail();
            })
        },
        forBuilding() {
            return this.editMode ? ' ' : this.form.errors.get('building')
        },

        forVisitType() {
            return this.editMode ? ' ' : this.form.errors.get('visitType')
        },

        async syncVisitType() {
            await axios.get('/api/get-visit-types/')
                .then((data) => {
                    this.visitType = data.data.data;
                })
                .catch((e) => {

                });
        },

        async syncBuilding() {
            await axios.get('/api/get-buildings/')
                .then((data) => {
                    this.building = data.data.data;
                })
                .catch((e) => {

                });
        },
    },
    created() {
        this.getData()
        this.moment = moment;
        this.syncVisitType();
        this.syncBuilding();
    },
    beforeMount() {
        this.permissions = {
            view: userAuthStore().role.permissions.visitors.includes('view') ?? false,
            create: userAuthStore().role.permissions.visitors.includes('create') ?? false,
            update: userAuthStore().role.permissions.visitors.includes('update') ?? false
        }
    }
}

</script>