<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div
            class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10"
        >
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-extrabold leading-6 text-gray-900">
                        ROLES
                    </h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the user roles including their role type
                        and permissions.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        @click.prevent="setOpen"
                        type="button"
                        class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                    >
                        Add Role
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-3 mt-8">
                <div class="col-span-3">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Roles
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-3 py-4 text-xs text-gray-500"
                                            >
                                                System Administrator
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-3 py-4 text-xs text-gray-500"
                                            >
                                                System Tester
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-3 py-4 text-xs text-gray-500"
                                            >
                                                Unit Owner
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-9">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <div
                                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"
                            >
                                <table
                                    class="min-w-full divide-y divide-gray-300"
                                >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="text-left py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Module
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                View
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Create
                                            </th>
                                            <th
                                                scope="col"
                                                class="text-center py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6"
                                            >
                                                Update
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                Dashboard
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                User List
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                User Roles
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                Buildings
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                Visitors
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                Deliveries
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                Maintenance
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                            <td
                                                class="text-center w-72 break-all px-6 py-4 text-xs text-gray-500"
                                            >
                                                <input type="checkbox" checked>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    Switch,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";
</script>
