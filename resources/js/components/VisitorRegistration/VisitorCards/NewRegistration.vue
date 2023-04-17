<template>
    <div class="min-w-full flex absolute sm:top-0 items-center justify-center overflow-hidden">
        <div
            class="relative overflow-hidden shadow-sm shadow-slate-400 w-[340px] sm:w-[600px] lg:w-[960px] h-[880px] m-8 p-5 lg:p-10 rounded-md">
            <span class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-green-300 via-green-500 to-green-600"></span>
            <div class="text-center my-5">
                <p class=" text-2xl md:text-3xl font-semibold">Building Name</p>
                <p class="text-gray-600 text-[12px] md:text-sm p-1">Building Address</p>
                <p class="text-lg md:text-xl font-bold text-green-600">Visitor Registration</p>
            </div>

            <div class="my-14 md:my-12 md:mx-10">
                <form action="">
                    <div>
                        <label for="email" class="block text-xs md:text-sm font-medium leading-6 text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="fname" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">First Name</label>
                        <div class="mt-2">
                            <input id="fname" name="fname" type="fname" autocomplete="fname"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="lname" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Last Name</label>
                        <div class="mt-2">
                            <input id="lname" name="lname" type="lname" autocomplete="lname"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="contact" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Contact Number</label>
                        <div class="mt-2">
                            <input id="contact" name="contact" type="contact" autocomplete="contact"
                                class="block w-full rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div>
                        <label for="valid_id" class="block text-xs md:text-sm font-medium leading-6 text-gray-900 mt-2">Valid ID</label>
                        <div class="mt-2">
                            <v-select id="dropdown" placeholder="Select" :options="valid_id"
                                label="label" class="text-xs"></v-select>
                        </div>
                    </div>





                </form>
            </div>



        </div>

    </div>
</template>

<script>

export default{
    data(){
        return{
            valid_id:[
                "Digitalized BIR Taxpayer's ID",
                'Digitized Postal ID',
                'Diplomat ID',
                "Driver's License",
                'GSIS Card',
                'IBP ID',
                'OFW ID',
                'OWWA ID',
                'Passport',
                'PRC ID',
                "Senior Citizen's ID Card",
                'SSS Card',
                'UMID Card',
                "Voter's ID"
            ],
        }
    }
}

</script>