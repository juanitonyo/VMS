<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">SMS Template Table</h1>
            <p class="mt-2 text-sm text-gray-700">A catalog of all SMS template maintenance entries.</p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button @click.prevent="setOpen" type="button" class="block rounded-md bg-cyan-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Compose SMS</button>
        </div>
    </div>
        <div class="mt-8 flow-root">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Message</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Description</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">Action</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500"></td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                            <a href="#" class="text-cyan-600 hover:text-cyan-900">Edit</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

        <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'SMS Template'" :description="'A roster of all building types associated with your account, including their category, description and location.'">
            <template v-slot:slider-body>
                <form @submit.prevent="editMode ? updateBuilding() : saveBuilding()">
                    <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                        <div class="my-4 grid grid-cols-1">
                            <div class="sm:col-span-3">
                                <label for="building-name" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
                                <div class="mt-2">
                                    <input v-model="form.name" type="text" name="building-name" id="building-name" autocomplete="given-name" class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                            <div class="sm:col-span-3 mt-3">
                                <label for="building-name" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                    <input v-model="form.description" type="text" name="building-name" id="building-name" autocomplete="given-name" class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                            <div class="sm:col-span-3 mt-3">
                                <Toogle v-model="form.status" title="Status" :hasDescription="false"></Toogle>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                        <button type="button" class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400" @click="setOpen">Cancel</button>
                        <button type="submit" class="ml-4 inline-flex justify-center rounded-md bg-cyan-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-500">{{editMode ? 'Update' : 'Save'}}</button>
                    </div>
                </form>
            </template>
        </SliderVue>
</template>

<script>

import axios from "axios";
import Form from "vform";
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import Toogle from '@/components/Elements/Switch/Toogle.vue'
import { createToast } from 'mosha-vue-toastify';

export default{
  name:"SMSTemplateTable",
  props: {
    data:{
        type: Array,
        default: {}
    },
  },
  components:{
    SliderVue, Toogle
  },
  data () {
    return {
        data:{},
        editMode:false,
        open:false,
        form: new Form({
            id:'',
            name:'',
            description:'',
            status:true,
        }),
    }
  },
  methods: {
    setOpen(){
        this.editMode = false;
        this.open = !this.open;
    },
  },
    
    
}

</script>