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
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="item in this.data.data" :key="item.id">
                                        <td class="text-left px-3 py-4 text-xs text-gray-900 sm:pl-6 w-48">{{
                                            item.visitor.name }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.building.building_name
                                        }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.visit_type.name }}
                                        </td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.status == 0 ?
                                            'Pending Approval' : item.status == 1 ?
                                                'Approved' : 'Disapproved' }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{
                                            moment(item.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</td>
                                        <td class="text-left px-3 py-4 text-xs text-gray-500">{{ item.is_checked_out ?
                                            moment(item.updated_at).format('MMMM Do YYYY, h:mm:ss a') : "Not Yet" }}
                                        </td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs flex gap-1 w-full justify-center items-center"
                                            v-if="permissions.update">
                                            <a v-show="item.status == 0 || item.status == -1"
                                                class="approve text-white bg-green-400 rounded-md p-1 cursor-pointer"
                                                @click.prevent="setShow('Approval', item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </a>
                                            <a v-show="item.status == 1"
                                                class="approve text-white bg-red-400 rounded-md p-1 cursor-pointer"
                                                @click.prevent="setShow('Disapproval', item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </a>
                                            <a @click.prevent="editVisitors(item)"
                                                class="flex justify-center text-blue-900 border border-blue-900 p-1 rounded-md cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </a>
                                            <a v-show="item.is_checked_out && item.status"
                                                @click.prevent="setShow('Invite', item)"
                                                class="flex justify-center text-blue-900 border border-blue-900 p-1 rounded-md cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                    </path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                            </a>
                                            <a v-show="!item.is_checked_out && item.status"
                                                @click.prevent="setShow('Check Out', item)"
                                                class="flex justify-center text-blue-900 border border-blue-900 p-1 rounded-md cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9" />
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
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'View ' : 'Add ') + 'Visitors'"
        :description="'A visitor in the database'">
        <template v-slot:slider-body>
            <div class="relative flex-1 py-2 sm:px-4 space-y-5">

                <div class="flex items-center justify-center mt-6">
                    <img :src="'/uploads/profiles-visitor/' + this.account.visitor.profile_photo"
                        class="relative w-[100px] h-[100px] border border-black rounded-full ">
                    <svg v-if="this.account.visitor.profile_photo == null" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute">
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
                            <p>{{ this.account.log_type }}</p>
                            <p>N/A</p>
                            <p>{{ this.account.visitor.valid_id }}</p>
                            <p>{{ this.account.user == null ? 'None' : this.account.user.first_name + ' ' +
                                this.account.user.last_name }}</p>
                            <p>{{ this.account.user == null ? 'None' : this.account.user.email }}</p>
                            <p>{{ this.account.visitor.ref_code }}</p>
                            <p>{{ this.account.building.building_name }}</p>
                            <p>{{ this.account.visit_type.name }}</p>
                            <p>{{ moment(this.account.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                            <p>{{ this.account.checked_in_by == null ? 'N/A' : this.account.checked_in_by }}</p>
                            <p>{{ this.account.created_at == this.account.updated_at ? 'Not Yet' :
                                moment(this.account.updated_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                            <p></p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>N/A</p>
                            <p>{{ this.health_form == null ? "None" : this.health_form }}</p>
                            <p>N/A</p>
                        </div>
                    </div>
                    <div class="flex justify-end w-full mt-10">
                        <button type="button" class="rounded-md bg-gray-900 text-white py-2 px-6 text-sm font-semibold"
                            @click="setOpen">Close</button>
                    </div>
                </div>
            </div>
        </template>
    </SliderVue>

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
                                <span v-show="this.editMode ? false : form.errors.has('building')"
                                    class="text-[10px] text-red-600 dark:text-red-500">{{ forBuilding() }}</span>
                            </div>
                            <v-select v-model="form.building_id" placeholder="Search" :options="building" label="label"
                                :class="this.editMode ? ' ' : [form.errors.has('building') ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700' : ' ']"></v-select>
                        </div>

                        <div class="sliderPurpose sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="visit_type" class="block text-sm font-medium leading-6 text-gray-900">Purpose of
                                    Visit</label>
                                <span v-show="this.editMode ? false : form.errors.has('visit_type')"
                                    class="text-[10px] text-red-600 dark:text-red-500">{{ forVisitType() }}</span>
                            </div>
                            <v-select v-model="form.visit_purpose_id" placeholder="Search" :options="visit_type"
                                label="label"
                                :class="this.editMode ? ' ' : [form.errors.has('visit_type') ? 'bg-red-50 border-red-500 text-red-900 placeholder-red-700' : ' ']"></v-select>
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
                                <div class="text-[10px] text-red-600 dark:text-red-500 mt-1"
                                    v-if="form.errors.has('companion')" v-html="form.errors.get('companion')" />
                            </div>
                            <textarea v-model="form.companions"
                                class="focus:outline-none p-2 text-xs resize-none w-full h-20 rounded-md border border-gray-300"
                                :class="this.editMode ? ' ' : [form.errors.has('companion') ? 'border-red-500 bg-red-50' : 'border border-gray-300 bg-white']"></textarea>
                            <p class="text-gray-500 text-[10px] text-left italic font-light">Note: Please type the name/s of
                                the companion. If multiple names, seperate each with a comma ( , ).</p>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <!-- <NormalInput label="Target Date / Time" id="dateTime"
                                :hasError="this.editMode ? false : form.errors.has('dateTime')"
                                :errorMessage="this.editMode ? false : form.errors.get('dateTime')"></NormalInput> -->
                            <div class="flex justify-between">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Target Date</label>
                                <div class="text-[10px] text-red-600 dark:text-red-500 mt-1" v-if="form.errors.has('date')"
                                    v-html="form.errors.get('date')" />
                            </div>
                            <input v-model="form.target_date" type="date"
                                :class="this.editMode ? ' ' : [form.errors.has('date') ? 'border-red-500 bg-red-50' : 'border border-gray-300 bg-white', 'focus:outline-none px-3 py-2 text-xs w-full rounded-md border border-gray-300']" />
                        </div>


                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setPop">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Send</button>
                </div>
            </form>
        </template>
    </SliderVue>

    <DialogVue :isOpen="show" :dialogTitle="'Reason for ' + statusChoice" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>

            <p class="text-xs mb-1">Please state your reason:</p>
            <textarea name="reason" id="reason" class="w-full h-36 rounded-md focus:outline-none border p-2 text-sm" />

            <div class="mt-4 flex gap-1">
                <button @click.prevent="this.statusChoice == 'Invite' ? sendInvitation() : updateVisitor(statusChoice)"
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
import axios from 'axios';
import { userAuthStore } from "@/store/auth";
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import NormalInput from '@/components/Elements/Inputs/NormalInput.vue'
import moment from 'moment';
import Form from 'vform';
import DialogVue from '@/components/Elements/Modals/Dialog.vue'

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
            log: {},
            editMode: false,
            open: false,
            pop: false,
            isChanged: false,
            account: {},
            form: new Form({
                email: '',
                first_name: '',
                last_name: '',
                building_id: '',
                visit_purpose_id: '',
                location: '',
                contact: '',
                companions: '',
                target_date: ''
            }),
            visit_type: [],
            building: [],
            show: false,
            statusChoice: ''
        }
    },

    components: {
        SliderVue, NormalInput, Switch, SwitchGroup, SwitchLabel, DialogVue
    },
    methods: {
        editVisitors(item) {
            this.editMode = true
            this.open = !this.open
            this.account = item
        },
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
        },
        setPop() {
            this.pop = !this.pop;
        },

        setShow(choice, item) {
            this.statusChoice = choice;
            this.log = item;
            this.show = !this.show
        },

        async getData(page = 1) {
            if (userAuthStore().user.role_id == 2) {
                await axios.get('/api/get-visitors-by-user?page=' + page + '&id=' + userAuthStore().user.id).then((data) => {
                    this.data = data.data.data;
                    console.log(this.data)
                }).catch((e) => {
                    // errorMessage('Opps!', e.message, 'top-right')
                });
            }
            else {
                await axios.get('/api/get-logs?page=' + page).then((data) => {
                    this.data = data.data.data;
                    console.log(this.data)
                }).catch((e) => {
                    // errorMessage('Opps!', e.message, 'top-right')
                });
            }
        },

        saveInvitation() {
            this.form.building_id = this.form.building_id.value
            this.form.visit_purpose_id = this.form.visit_purpose_id.value

            this.form.post('/api/invitation/')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.pop = !this.pop;
                    this.sendInvitation();
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

        sendInvitation() {
            axios.get('/api/send-email?emailPurpose=invitation').then((data) => { this.show = !this.show }).catch((error) => { })
        },

        updateVisitor(triggered) {
            if (triggered == 'Approval') {
                this.log.status = 1
            }

            else if (triggered == 'Disapproval') {
                this.log.status = -1
            }

            else if (triggered == 'Check Out') {
                this.log.checked_out_by = userAuthStore().user.name
                this.log.is_checked_out = 1
            }

            axios.put("/api/visitor-logs/" + this.log.visitor.id, {
                params: {
                    data: this.log
                }
            }).then((data) => {
                this.$Progress.finish();
                this.getData();
                this.show = !this.show
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
            return this.editMode ? ' ' : this.form.errors.get('visit_type')
        },

        async syncVisitType() {
            await axios.get('/api/get-visit-types/')
                .then((data) => {
                    this.visit_type = data.data.data;
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