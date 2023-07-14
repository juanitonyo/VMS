<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-blue-800">PROPTECH DATA SYNC</h1>
                    <p class="mt-2 text-xs text-gray-700">Transfer information from PropTech to VMS in synchronization</p>
                </div>
                <div class="mt-4 flex gap-1 sm:mt-0 sm:ml-16 sm:flex-none" v-if="permissions.create">
                    <button type="button" @click.prevent="syncData()"
                        class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">SYNC
                        PROPTECH</button>
                    <button type="button" @click.prevent="processRecords()"
                        class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">SYNC
                        UNIT OWNERS</button>
                </div>

            </div>
            <div class="mt-8 flow-root" v-if="permissions.view">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 ">
                        <div
                            class=" shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg flex flex-col h-[400px] items-center justify-center">

                            <Vue3Lottie v-if="isSync && progressBar < 100"
                                animationLink="https://lottie.host/157d2638-4df8-41e6-be42-b8b94e355408/kRlVez8oo7.json"
                                :loop="true" class="w-[150px]" />
                            <Vue3Lottie v-if="progressBar == 100"
                                animationLink="https://assets1.lottiefiles.com/packages/lf20_rc5d0f61.json"
                                :loop="false" class="w-[150px]" />
                            <div v-if="isSync" class="bg-gray-200 h-1 w-40 rounded-full">
                                <div class="bg-blue-500 h-full rounded-full "
                                    :class="progressBar == 100 ? 'bg-green-500' : ''" :style="'width:' + progressBar + '%'">
                                </div>
                            </div>
                            <!-- <p class="w-full py-4 pl-2 rounded-md shadow-sm shadow-gray-400 mb-2"
                                    v-for="(item, index) in messages" :key="index">{{ item }}</p> -->
                            <!-- <p v-for="(item, index) in messages" :key="index">{{ item }}</p> -->
                            <p v-if="isSync && progressBar < 100" class="text-[10px]">Loading resources: {{
                                this.building.name }}</p>
                            <p v-if="progressBar == 100" class="text-[10px]">Sync Complete</p>
                        </div>
                        <div class="flex space-x-2 mt-2">

                            <div
                                class="text-sm flex items-center justify-center gap-1 text-blue-800 bg-white border border-blue-800 rounded-md py-1 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                                <p>Data Count: {{ this.realtimeLength }} / {{ this.unitOwnersLength }}</p>
                            </div>
                            <div
                                class="text-sm flex items-center justify-center gap-1 text-blue-800 bg-white border border-blue-800 rounded-md py-1 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                </svg>
                                <p>Data Saved: {{ this.dataCount }}</p>
                            </div>
                            <ul>
                                <li v-for="item in currentData" :key="item.id">{{ item.name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { userAuthStore } from "@/store/auth";
import moment from 'moment';
import { createToast } from 'mosha-vue-toastify'
import { Vue3Lottie } from 'vue3-lottie'


export default {
    name: 'sync',
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
            messages: [],
            counter: 1,
            progressBar: 0,
            currentData: [],
            dataCount: 0,
            realtimeLength: 0,
            unitOwnersLength: 0,
            syncTimeTriggered: '',
            building: [],
            isSync: false
        }
    },
    components: {
        Vue3Lottie
    },
    methods: {
        async syncData() {
            this.counter = 1;
            this.progressBar = 0;
            this.isSync = !this.isSync;
            await axios.get('https://proptech-api.globalland.com.ph/api/vms/sync-buildings')
                .then((data) => {
                    data.data.forEach((item, index) => {
                        setTimeout(() => {
                            this.progressBar = (this.counter++ / data.data.length) * 100;
                            // this.messages.push(data.data.messasge)
                            this.saveBuilding(item);
                            this.building = item;
                        }, index * 150);
                    })

                })
                .catch((e) => {

                });
        },
        async syncUnitOwners() {
            this.syncTimeTriggered = new Date().toISOString();
            this.fetchLatestData();

            await axios.post('/api/get-unit-owners-length').then((data) => {
                this.unitOwnersLength = data.data.data

            })

            await axios.post('/api/sync-unit-owners').then((data) => {
                if (data.data.success) {
                    clearInterval(this.interval);
                }
            })
        },
        async processRecords() {
            this.syncTimeTriggered = new Date().toISOString();
            createToast({
                title: 'Please wait!',
                description: 'Syncing data is ongoing....'
            },
                {
                    position: 'top-right',
                    showIcon: 'true',
                    type: 'success',
                    toastBackgroundColor: '#00bcd4',
                    hideProgressBar: 'true',
                    toastBackgroundColor: '#00bcd4',
                })
            try {
                const response = await axios.get('https://proptech-api.globalland.com.ph/api/vms/sync-unit-owners');
                const records = response.data;

                const batchSize = 150;
                const totalBatches = Math.ceil(records.length / batchSize);
                console.log(records.length)

                for (let i = 0; i < totalBatches; i++) {
                    const start = i * batchSize;
                    const end = start + batchSize;

                    const batchRecords = records.slice(start, end);

                    await axios.post('/api/sync-unit-owners', { data: batchRecords, date_generated: this.syncTimeTriggered, total_length: records.length });

                    await this.delay(5000);
                }

                createToast({
                    title: 'Success!',
                    description: 'Unit Owners Syncing Complete!'
                },
                    {
                        position: 'top-right',
                        showIcon: 'true',
                        type: 'success',
                        toastBackgroundColor: '#00bcd4',
                        hideProgressBar: 'true',
                        toastBackgroundColor: '#00bcd4',
                    })
            } catch (error) {
                console.error('Error occurred:', error);
            }
        },
        delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        },


        fetchLatestData() {
            this.currentData = []
            axios.get('/api/fetch-realtime-data', {
                syncTimeTriggered: this.syncTimeTriggered
            }).then((data) => {
                this.realtimeLength = data.data.data.length
                this.currentData = data.data.data
            })
        },

        saveBuilding(buildingData) {
            axios.post('/api/sync-building', buildingData).then((data) => {
                this.messages.push(data.data.message)
            }).catch((error) => {
                this.messages.push(error.response.data.data)
            })
        },
        subscribeToJobChannel() {
            const channel = this.$pusher.subscribe('sync-unitowners-channel');
            channel.bind('pusher:subscription_succeeded', () => console.log('subscription succeeded'))
            channel.bind('sync-unitowners-broadcast', event => {
                // console.log(event);
                createToast({
                    title: 'Syncing Data...',
                    description: event.data.user_initial_count + ' out of ' + event.data.user_total_count
                },
                    {
                        position: 'top-right',
                        showIcon: 'true',
                        type: 'success',
                        toastBackgroundColor: '#00bcd4',
                        hideProgressBar: 'true',
                        timeout: 30000,
                        toastBackgroundColor: '#00bcd4',
                    })
            })

        },
    },
    created() {
        this.subscribeToJobChannel();
    },
    mounted() {
        // this.interval = setInterval(this.fetchLatestData, 5000);
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