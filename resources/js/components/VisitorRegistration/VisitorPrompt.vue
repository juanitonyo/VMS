<template>
    <div class="min-w-full min-h-screen flex items-center justify-center overflow-hidden bg-background bg-cover">
        <div class="overflow-hidden shadow-sm shadow-slate-500 m-3 p-5 md:p-10 rounded-xl bg-white">
            <h1 class="flex justify-center items-center text-xs lg:text-sm">You are about to enter</h1>

            <div class="flex flex-col items-center justify-center md:m-1">
                <p class="m-3 text-2xl md:text-3xl text-blue-800 font-bold uppercase">{{ this.buildings.building_name }}</p>
                <img :src="[this.buildings.logo ? '/uploads/images/' + this.buildings.logo : '/uploads/images/default-image.png']" alt="no photo"
                    class="shadow-lg shadow-indigo-200 rounded-md flex items-center justify-center" :class="this.buildings.logo ? '' : 'w-[200px] p-10 opacity-75'">
            </div>

            <div class="flex text-center justify-center items-center text-[10px] md:text-xs text-gray-600 mt-3">
                <p>By clicking <strong class="text-black">proceed</strong>, you agree with our <a href="/Terms-and-Condition#privacy" target="_blank" class="text-indigo-600">privacy policy</a> and <a href="/Terms-and-Condition" target="_blank" class="text-indigo-600">terms and conditions</a>.</p>
            </div>

            <div class="buttons flex flex-col mt-5 text-center">
                <router-link :to="'/visitor-registration/index/' + this.id"
                    class="bg-blue-900 border rounded-md text-white text-sm font-medium py-1 outline-none hover:bg-blue-900/90">Proceed</router-link>
                <router-link to="/app/buildings"
                    class="border border-gray-400 rounded-md text-sm font-medium py-1 mt-1.5 outline-none hover:bg-gray-50">Go
                    Back</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Visitor Prompt',
    props: {
        data: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            data: {},
            id: window.location.href.split('/').pop(),
            buildings: {},
        }
    },
    created() {
        axios.get('/api/visitor-registration?buildingUUID=' + this.id)
            .then((data) => { 
                this.buildings = data.data.data;
            })
            .catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
        });

        
    },
}

</script>