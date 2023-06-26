<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">QR CODE SUMMARY</h1>
                    <p class="mt-2 text-xs text-gray-700">A summary of QR codes of all the buildings</p>
                </div>
                <div class="relative">
                    <input type="text" name="search" class="h-[30px] border border-gray-500 rounded-md pl-2 text-xs w-80"
                        placeholder="Search: Building Name">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="absolute w-4 h-4 top-1.5 right-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col">
                <div v-for="item in data.data" class="flex mt-8 gap-2">

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img :src="this.qr_url + this.baseURL + '/homeowner-registration/' +  item.qr_id "
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Unit Owner</p>
                                <p class="font-semibold">{{ item.building_name }}</p>
                                <p class="text-[10px] font-extralight text-gray-400 w-80">{{ item.address }}</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">{{ item.description ?? ''}}</p>
                                <a :href="this.baseURL + '/homeowner-registration/' +  item.qr_id" target="_blank" class="font-light text-xs mt-3 text-blue-500">> Proceed to host registration</a>
                            </div>
                        </div>
                    </div>

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img :src="this.qr_url + this.baseURL + '/visitor-registration/' +  item.qr_id "
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Visitor</p>
                                <p class="font-semibold">{{ item.building_name }}</p>
                                <p class="text-[10px] font-extralight text-gray-400 w-80">{{ item.address }}</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">{{ item.description ?? ''}}</p>
                                <a :href="this.baseURL + '/visitor-registration/' +  item.qr_id" target="_blank" class="font-light text-xs mt-3 text-blue-500">> Proceed to visitor registration</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true"
                    :perPage="size" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { TailwindPagination } from 'laravel-vue-pagination';

export default {
    props: {
        data: {
            type: Object,
            default: {}
        }
    },

    components:{
        TailwindPagination
    },
    data() {
        return {
            data: {},
            qr_url: 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=',
            url: '',
            baseURL: ''
        }
    },
    methods: {
        async getData(page = 1) {
            await axios.get('/api/building?page=' + page).then((data) => {
                this.url = new URL(window.location.href);
                this.baseURL = this.url.origin;
                this.data = data.data.data
                console.log(this.data);
            }).catch((error) => {

            })
        },
    },
    created() {
        this.getData();
    }
}

</script>