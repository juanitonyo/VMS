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
        }
    },
    components: {
    },
    methods: {
        async syncData() {
            await axios.get('http://proptech-api.test/api/vms/sync-buildings')
                .then((data) => {
                   
                    data.data.forEach((item, index) => {
                        setTimeout(() => {
                            this.progressBar = (this.counter++ / data.data.length) * 100;
                            console.log(this.progressBar)
                            this.saveBuilding(item);
                        }, index * 150);
                    })
                    
                })
                .catch((e) => {
                    
                });
        },

        saveBuilding(buildingData){
            axios.post('/api/sync-building', buildingData).then((data) => {
                console.log(data)
            }).catch((error) => {
                this.messages.push(error.response.data.data)
            })
        }
    },
    created() {
 
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