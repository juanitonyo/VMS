<template>
    <div class="container w-full md:rounded-full rounded-md border md:h-16 h-80 mb-5 flex justify-evenly items-center md:flex-row flex-col">
        <div class="flex items-center md:flex-row flex-col space-y-3 md:space-y-0 md:space-x-5 md:m-0 mx-5" :class="isHidden">
            <p class="text-xs">Filter By:</p>
            <div class="flex space-x-1 text-xs text-white">
                <button class="focus:bg-blue-600 rounded-full w-14 bg-blue-500 py-1">Day</button>
                <button class="focus:bg-blue-600 rounded-full w-14 bg-blue-500">Week</button>
                <button class="focus:bg-blue-600 rounded-full w-14 bg-blue-500">Month</button>
                <button class="focus:bg-blue-600 rounded-full w-14 bg-blue-500">Year</button>
            </div>
        </div>

        <div class="flex flex-col text-xs">
            <label for="from" class="text-blue-700 text-[10px] pl-1">From date</label>
            <input v-model="this.value1" type="date" name="from" id="from" class="uppercase focus:outline-none w-32">
        </div>

        <div class="md:w-[1px] w-60 bg-gray-300 md:h-10 h-[1px]"></div>

        <div class="flex flex-col text-xs">
            <label for="from" class="text-blue-700 text-[10px] pl-1">To date</label>
            <input v-model="this.value2" type="date" name="from" id="from" class="uppercase focus:outline-none w-32">
        </div>

        <button @click="clickedFilter" class="border border-blue-500 rounded-full px-10 py-[1px] text-sm hover:bg-blue-500 hover:text-white">
            Filter
        </button>
    </div>
</template>

<script>
import moment from 'moment';

export default{
    props:{
        isHidden:{
            type: String,
            default: '',
        },
    },
    data() {
        return {
            value1: '',
            value2: ''
        }
    },
    methods: {
        clickedFilter() {
            this.$emit('filter-date', {
                value1: moment(this.value1).format('YYYY-MM-DD 00:00:00'),
                value2: moment(this.value2).format('YYYY-MM-DD 23:59:59')
            });
        }
    },
    created() {
        this.moment = moment
        this.value1 = moment().format('YYYY-MM-DD')
        this.value2 = moment().format('YYYY-MM-DD')
    }
}
</script>