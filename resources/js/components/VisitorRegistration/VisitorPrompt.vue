<template>
    <div class="min-w-full flex absolute top-36 sm:top-3  items-center justify-center overflow-hidden">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 m-5 p-5 md:p-10">
            <h1 class="flex justify-center items-center text-xs md:text-lg">YOU ARE ABOUT TO ENTER ...</h1>

            <div class="flex flex-col items-center justify-center md:m-3">
                <p class="m-3 text-base md:text-3xl font-bold">{{ this.buildings.buildingName }}</p>
                <img src="https://picsum.photos/400/400?grayscale" alt="no photo"
                    class="shadow ring-1 ring-black ring-opacity-5">
            </div>

            <div class="flex text-center justify-center items-center text-xs md:text-sm text-gray-600">
                <p>By clicking <strong class="text-black">proceed</strong>, you agree with our <a href="" class="text-cyan-500">privacy policy</a> and <a href="" class="text-cyan-500">terms and conditions</a>.</p>
            </div>

            <div class="buttons flex flex-col mt-5 text-center">
                <router-link :to="'/visitor-registration/index/' + this.id"
                    class="bg-cyan-500 border rounded-md text-white text-sm md:text-base font-medium py-1 outline-none">Proceed</router-link>
                <router-link to="/app/buildings"
                    class="border border-cyan-500 rounded-md text-sm md:text-base font-medium py-1 mt-1.5 outline-none">Go
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
        axios.get('/api/visitor-registration/' + this.id)
            .then((data) => { 
                this.buildings = data.data.data;
            })
            .catch((e) => {
                errorMessage('Opps!', e.message, 'top-right')
        });
    },
}

</script>