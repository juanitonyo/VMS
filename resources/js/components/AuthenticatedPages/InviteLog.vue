<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">INVITATIONS</h1>
                    <p class="mt-2 text-xs text-gray-700">Log of all invitation in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" @click.prevent="setPop()"
                        class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Send
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
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Building</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Visit Type</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Checked In</th>
                                        <th scope="col" class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Checked Out</th>
                                        <th scope="col" class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Target Date</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody v-for="invitation in data.data" :key="invitation.id" class="divide-y divide-gray-200 bg-white">
                                    <tr v-if="this.data.data.length === 0">
                                        <td class="text-center px-3 py-4 text-xs text-gray-900 sm:pl-6" colspan="7">
                                            No data available
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left px-3 py-4 text-xs text-gray-900 sm:pl-6 w-48">{{ invitation.first_name + ' ' + invitation.last_name }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ invitation.building.building_name }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ invitation.visit_type.name }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">N/A</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ invitation.latest_log ?? false ? invitation.latest_log.created_at : 'Not yet' }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ invitation.latest_log ?? false ? [invitation.latest_log.is_checked_out ? invitation.latest_log.updated_at : 'Not yet'] : 'Not yet' }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ moment(invitation.target_date).format('MMMM Do YYYY, h: mm: ss a') }}</td>
                                        <td
                                            class="relative text-center py-4 pl-3 pr-4 text-xs flex gap-1 w-full justify-center items-center">
                                            <button v-if="moment().isSameOrAfter(invitation.target_date)" 
                                                @click.prevent="setShow('Approval', item)"
                                                class="approve text-white bg-green-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </button>
                                            <button v-if="moment().isSameOrAfter(invitation.target_date)" 
                                                @click.prevent="setShow('Disapproval', item)"
                                                class="approve text-white bg-red-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <button 
                                                class="flex justify-center text-blue-900 border border-blue-900 p-1 rounded-md cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </button>
                                            <button v-if="invitation.latest_log ?? false ? [(!invitation.latest_log.is_checked_out && moment().isSameOrAfter(invitation.target_date)) && invitation.latest.status == 1] : false"
                                                @click.prevent="setShow()"
                                                class="flex justify-center text-blue-900 border border-blue-900 p-1 rounded-md cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
    </div>

    <SliderVue :setOpen="pop" :title="'Send Invitation'" :description="'Invite someone to your location'">
        <template v-slot:slider-body>
            <form @submit.prevent="saveInvitation">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.email" label="Email" id="email"
                                :hasError="this.editMode ? false : form.errors.has('email')"
                                :errorMessage="this.editMode ? false : form.errors.get('email')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.first_name" label="First Name" id="first_name"
                                :hasError="this.editMode ? false : form.errors.has('first_name')"
                                :errorMessage="this.editMode ? false : form.errors.get('first_name')"></NormalInput>
                        </div>


                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.last_name" label="Last Name" id="last_name"
                                :hasError="this.editMode ? false : form.errors.has('last_name')"
                                :errorMessage="this.editMode ? false : form.errors.get('last_name')"></NormalInput>
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="building"
                                    class="block text-sm font-medium leading-6 text-gray-900">Building</label>
                                <span v-show="form.errors && (form.errors.has('building_id') ?? false)" v-html="form.errors && (form.errors.has('building_id') ?? false) ? form.errors.get('building_id').replace('id', '') : ''"
                                    class="text-[10px] text-red-600 dark:text-red-500 mt-1"></span>
                            </div>
                            <v-select v-model="form.building_id" placeholder="Search" :options="building" label="label"
                                :class="form.errors && (form.errors.has('building_id') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''"></v-select>
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="visit_type" class="block text-sm font-medium leading-6 text-gray-900">Purpose of
                                    Visit</label>
                                <span v-show="form.errors && (form.errors.has('visit_purpose_id') ?? false)" v-html="form.errors && (form.errors.has('visit_purpose_id') ?? false) ? form.errors.get('visit_purpose_id').replace('id', '') : ''"
                                    class="text-[10px] text-red-600 dark:text-red-500 mt-1"></span>
                            </div>
                            <v-select v-model="form.visit_purpose_id" placeholder="Search" :options="visit_type"
                                label="label"
                                :class="form.errors && (form.errors.has('visit_purpose_id')) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ' '"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.location" label="Location" id="location"
                                :hasError="this.editMode ? false : form.errors.has('location')"
                                :errorMessage="this.editMode ? false : form.errors.get('location')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.contact" label="Contact" id="contact"
                                :hasError="this.editMode ? false : form.errors.has('contact')"
                                :errorMessage="this.editMode ? false : form.errors.get('contact')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Companion/s</label>
                            </div>
                            <textarea v-model="form.companions"
                                class="focus:outline-none p-2 text-xs resize-none w-full h-20 rounded-md border border-gray-300"></textarea>
                            <p class="text-gray-500 text-[10px] text-left italic font-light">Note: Please type the name/s of
                                the companion. If multiple names, seperate each with a comma ( , ). Leave blank if none.</p>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <!-- <NormalInput label="Target Date / Time" id="dateTime"
                                :hasError="form.errors.has('dateTime')"
                                :errorMessage="form.errors.get('dateTime')"></NormalInput> -->
                            <div class="flex justify-between">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Target Date</label>
                                <span v-show="form.errors && (form.errors.has('target_date') ?? false)" v-html="form.errors && (form.errors.has('target_date') ?? false) ? form.errors.get('target_date') : ''"
                                    class="text-[10px] text-red-600 dark:text-red-500 mt-1"></span>
                            </div>
                            <input v-model="form.target_date" type="date"
                                class="focus:outline-none px-3 py-2 text-xs w-full rounded-md border border-gray-300"
                                :class="form.errors && form.errors.has('target_date') ? 'border-red-500 bg-red-50' : ''" />
                        </div>


                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setPop">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-blue-800 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Send</button>
                </div>
            </form>
        </template>
    </SliderVue>
    <DialogVue :isOpen="show" :dialogTitle="'Reason for ' + statusChoice" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>

            <div v-if="statusChoice == 'Invite'" class="sliderPurpose sm:col-span-3 my-3">
                <label for="visit_type" class="block text-sm font-medium leading-6 text-gray-900">Purpose of
                    Visit</label>
                <v-select v-model="purpose" placeholder="Search" :options="visit_type" label="label"></v-select>
            </div>

            <p class="text-xs mb-1">Remark/s</p>
            <textarea name="reason" id="reason" class="w-full h-36 rounded-md focus:outline-none border p-2 text-sm" />

            <div class="mt-4 flex gap-1">
                <button
                    @click.prevent="this.statusChoice == 'Invite' ? saveInvitation(this.log) : updateVisitor(statusChoice)"
                    type="button"
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
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import { userAuthStore } from "@/store/auth";
import Form from 'vform';
import axios from 'axios';
import moment from 'moment';

export default {
    name: 'InviteLogs',
    props: {
        data: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            data: {},
            form: new Form({
                email: '',
                first_name: '',
                last_name: '',
                user_id: '',
                building_id: '',
                visit_purpose_id: '',
                location: '',
                contact: '',
                companions: '',
                target_date: '',
                status: ''
            }),
            show: false,
            statusChoice: '',
            visit_type: [],
            pop: false,
        }
    },

    components: {
        SliderVue, DialogVue, NormalInput, moment
    },

    methods: {
        setPop() {
            this.form = new Form({})
            this.pop = !this.pop;
        },

        sendInvitation(id) {
            axios.get('/api/send-email?emailPurpose=invitation&id=' + id + '&inviter=' + userAuthStore().user.name).then((data) => { this.show = !this.show }).catch((error) => { })
        },

        async syncVisitType() {
            await axios.get('/api/get-visit-types/')
                .then((data) => {
                    this.visit_type = data.data.data;
                })
                .catch((e) => {

                });
        },

        forBuilding(message) {
            const error = message;
            return error ? error.replace('building id', 'building') : ''
        },

        forVisitType(message) {
            const error = message;
            return error ? error.replace('visit purpose id', 'visit purpose') : ''
        },

        async syncBuilding() {
            await axios.get('/api/get-buildings/')
                .then((data) => {
                    this.building = data.data.data;
                })
                .catch((e) => {

                });
        },

        setShow(choice, item) {
            this.statusChoice = choice;
            this.log = item;
            this.show = !this.show
        },

        saveInvitation() {
            this.form.user_id = userAuthStore().user.id
            this.form.building_id = this.form.building_id.value
            this.form.visit_purpose_id = this.form.visit_purpose_id.value
            if(userAuthStore().role.id == 1 || userAuthStore().role.id == 2) {
                this.form.status = true;
            }
            else {
                this.form.status = false;
            }
            
            this.form.post('/api/invitation/')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.pop = !this.pop;
                    this.sendInvitation(data.data.data.id);
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

        updateInvitee() {

        },

        async getData(page = 1) {
            await axios.get('/api/invitation?page=' + page)
                .then((data) => {
                    this.data = data.data.data
                }).catch((error) => {

                })
        }
    },
    created() {
        this.getData();
        this.syncVisitType();
        this.syncBuilding();
        this.moment = moment;
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