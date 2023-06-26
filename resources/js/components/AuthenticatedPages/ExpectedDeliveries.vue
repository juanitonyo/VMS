<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">EXPECTED DELIVERIES</h1>
                    <p class="mt-2 text-xs text-gray-700">A catalog of all expected deliveries in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" @click.prevent="notif()"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Delivery
                        Notifications</button>
                </div>
            </div>


            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="w-56 px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Rider Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Mobile</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Company</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Building/s</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Expected Date</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="text-center px-3 py-4 text-xs text-gray-900"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td
                                            class="relative text-center py-4 pl-3 pr-4 text-xs flex gap-1 items-center justify-center">
                                            <a class="approve text-white bg-green-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </a>
                                            <a class="approve text-white bg-red-400 rounded-md p-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="flex items-center justify-center mt-3">
                <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true"/>
            </div> -->
        </div>
    </div>

    <DialogVue :isOpen="openNotif" :dialogTitle="'Delivery Notification'" :modalWidth="'max-w-lg'">
        <template v-slot:dialogBody>
            <div class="space-y-3">
                <div class="space-y-2">
                    <label for="courier_name">Courier / Company</label>
                    <input type="text" class="pl-2 h-8 w-full border border-black focus:outline-none rounded-md">
                </div>

                <div class="space-y-2">
                    <label for="date">Expected Delivery Date</label>
                    <input type="date" class="pl-2 h-8 w-full border border-black focus:outline-none rounded-md">
                </div>

                <div class="space-y-2">
                    <label for="date">Details (Optional)</label>
                    <textarea type="date" class="p-2 w-full border border-black focus:outline-none rounded-md"></textarea>
                </div>
            </div>

            <div class="mt-4 flex gap-1">
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md border border-gray-800 py-2 px-5 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-50">
                    Send
                </button>
                <button type="button"
                    class="inline-flex w-full justify-center rounded-md bg-gray-800 py-2 px-5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800/90"
                    @click.prevent="this.openNotif = !this.openNotif">
                    Close
                </button>
            </div>

        </template>
    </DialogVue>
</template>

<script>
import DialogVue from '@/components/Elements/Modals/Dialog.vue'

export default {

    components: {
        DialogVue
    },

    data() {
        return {
            openNotif: false
        }
    },

    methods: {
        notif() {
            this.openNotif = !this.openNotif;
        }
    }
}

</script>