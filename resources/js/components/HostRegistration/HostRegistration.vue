<template>
    <div class="min-w-full min-h-screen flex absolute top-36 sm:top-0  items-center justify-center overflow-hidden">
        <div class="overflow-hidden shadow-sm shadow-slate-400 m-3 p-5 md:p-10 rounded-lg">

            <div class="flex flex-col gap-y-2 items-center justify-center">
                <h2 class="text-xl font-semibold tracking-wide text-blue-700">{{ this.buildings.buildingName }}</h2>
                <h4 class="text-gray-400 text-xs text-center">{{ this.buildings.address }}</h4>
            </div>

            <p class="text-2xl font-bold tracking-normal text-blue-700 mt-5">User Registration</p>

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