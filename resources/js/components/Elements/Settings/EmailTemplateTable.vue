<template>
    <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Email Template Table</h1>
            <p class="mt-2 text-sm text-gray-700">A roster of all building types associated with your account, including their category, description and location.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button @click.prevent="setOpen" type="button" class="block rounded-md bg-cyan-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Add Entry</button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Subject</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Body</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Description</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Action</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4  text-center text-sm font-medium sm:pr-6">
                        <a @click.prevent="editEmail(item)" href="#" class="text-indigo-600 hover:text-indigo-900"
                            >Edit<span class="sr-only">, </span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'E-mail Description'" :description="'Insert Description here.'">
            <ckeditor :editor="editor"></ckeditor>
        </SliderVue>
</template>

<script>

import axios from "axios";
import Form from "vform";
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import Toogle from '@/components/Elements/Switch/Toogle.vue'
import { createToast } from 'mosha-vue-toastify';
import CKEditor from '@ckeditor/ckeditor5-build-classic';

export default{
  name:"EmailTemplateTable",
  props: {
    data:{
        type:Array,
        default:'',
    },
  },
  components:{
    SliderVue, 
    Toogle,
  },
  data () {
    return {
        editor:ClassicEditor,
        data:{},
        editMode:false,
        open:false,
        form: new Form({
            id:'',
            name:'',
            description:'',
            delivery_form: true,
            status:true,
        }),
        editor:CKEditor,    
    }
  },
  methods:{
    setOpen(){
        this.editMode = false;
        this.open = !this.open
    }
  }
    
}

</script>