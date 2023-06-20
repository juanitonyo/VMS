<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">PROPTECH DATA SYNC</h1>
                    <p class="mt-2 text-xs text-gray-700">Transfer information from PropTech to VMS in synchronization</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none" v-if="permissions.create">
                    <button type="button" @click.prevent="syncData()"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">SYNC PROPTECH</button>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none" v-if="permissions.create">
                    <button type="button" @click.prevent="processRecords()"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">SYNC UNIT OWNERS</button>
                </div>

            </div>
            <div class="mt-8 flow-root" v-if="permissions.view">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 ">
                        
                            
                       

                        <div class=" shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg relative">
                            <div class="bg-gray-200 h-2 rounded-t-lg absolute w-full">
                                <div class="bg-blue-500 h-full rounded-t-lg " :style="'width:'+progressBar+'%'"></div>
                            </div>
                            <div class="overflow-y-auto h-96">
                                <p v-for="(item,index) in messages" :key="index">{{ item }}</p>
                            </div>
                        </div>
                        <div>
                            
                                <p>Data Count: {{ realtimeLength }} / {{ unitOwnersLength }}</p>
                                <h2>Data Saved:</h2>
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
            messages:[],
            counter:1,
            progressBar: 0,
            currentData: [],
            dataCount: 0,
            realtimeLength:0,
            unitOwnersLength: 0,
            syncTimeTriggered: '',
        }
    },
    components: {
    },
    methods: {
        async syncData() {
            await axios.get('https://proptech-api.globalland.com.ph/api/vms/sync-buildings')
                .then((data) => {
                    data.data.forEach((item, index) => {
                        setTimeout(() => {
                            this.progressBar = (this.counter++ / data.data.length) * 100;
                            // this.messages.push(data.data.messasge)
                            this.saveBuilding(item);
                        }, index * 150);
                    })
                    
                })
                .catch((e) => {
                    
                });
        },
        async syncUnitOwners(){
            this.syncTimeTriggered = new Date().toISOString();
            this.fetchLatestData();
            
            await  axios.post('/api/get-unit-owners-length').then((data) => {
                 this.unitOwnersLength = data.data.data
         
            })

            await   axios.post('/api/sync-unit-owners').then((data) => {
                if(data.data.success){
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


        fetchLatestData(){
            this.currentData = []
            axios.get('/api/fetch-realtime-data',{
                syncTimeTriggered: this.syncTimeTriggered
            }).then((data) => {
                this.realtimeLength = data.data.data.length
                this.currentData = data.data.data
            })
        },

        saveBuilding(buildingData){
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
                        description: event.data.user_initial_count +' out of '+ event.data.user_total_count
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