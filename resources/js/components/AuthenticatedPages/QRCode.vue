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
                <div class="flex mt-8 gap-2">

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/QR_Code_Example.svg/1200px-QR_Code_Example.svg.png"
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Unit Owner</p>
                                <p class="font-semibold">Building Name</p>
                                <p class="text-[10px] font-extralight text-gray-400">Building Type</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">Lorem ipsum dolor sit, amet
                                    consectetur adipisicing elit. Vitae sit recusandae velit distinctio accusamus aut.</p>
                                <a href="#" class="font-light text-xs mt-3 text-blue-500">Link / URL Here</a>
                            </div>
                        </div>
                    </div>

                    <div class="card p-5 border border-gray-300 w-1/2 lg:h-56 h-80 rounded-xl">
                        <div
                            class="flex lg:flex-row flex-col card-body w-full h-full lg:space-x-3 space-y-3 items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/QR_Code_Example.svg/1200px-QR_Code_Example.svg.png"
                                class="lg:h-full h-32">
                            <div class="details text-center lg:text-left">
                                <p class="leading-3">Visitor</p>
                                <p class="font-semibold">Building Name</p>
                                <p class="text-[10px] font-extralight text-gray-400">Building Type</p>
                                <p class="mt-3 italic font-extralight text-gray-600 text-xs">Lorem ipsum dolor sit, amet
                                    consectetur adipisicing elit. Vitae sit recusandae velit distinctio accusamus aut.</p>
                                <a href="#" class="font-light text-xs mt-3 text-blue-500">Link / URL Here</a>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
</div></template>