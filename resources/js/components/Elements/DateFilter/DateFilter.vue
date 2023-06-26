<template>
    <div class="container w-full rounded-full border h-16 mb-5 flex justify-evenly items-center">
        <div class="flex items-center space-x-5">
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
            <input type="date" name="from" id="from" class="uppercase focus:outline-none w-32">
        </div>

        <div class="w-[1px] bg-gray-300 h-10"></div>

        <div class="flex flex-col text-xs">
            <label for="from" class="text-blue-700 text-[10px] pl-1">To date</label>
            <input type="date" name="from" id="from" class="uppercase focus:outline-none w-32">
        </div>

        <button class="border border-blue-500 rounded-full px-10 py-[1px] text-sm hover:bg-blue-500 hover:text-white">
            Filter
        </button>
    </div>
</template>