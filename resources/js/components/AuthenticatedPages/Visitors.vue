<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-cyan-600">VISITORS</h1>
                    <p class="mt-2 text-xs text-gray-700">Log of all visitors in the database</p>
                </div>

                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button"
                        class="block rounded-md bg-cyan-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Send
                        Invitation</button>
                </div>

            </div>
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="w-56 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Building</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Visit Type</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Status</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked In</th>
                                        <th scope="col" class="px-2 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Checked Out</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                            Actions</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="text-center px-3 py-4 text-xs text-gray-900 ">
                                        </td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="text-center px-3 py-4 text-xs text-gray-500"></td>
                                        <td class="relative text-center py-4 pl-3 pr-4 text-xs">
                                            <a href="#" class="text-cyan-600 hover:text-cyan-900">Edit<span
                                                    class="sr-only"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-3">
                <!-- <TailwindPagination :data="data" @pagination-change-page="getData" /> -->
            </div>
        </div>
    </div>
</template>

<script>

</script>