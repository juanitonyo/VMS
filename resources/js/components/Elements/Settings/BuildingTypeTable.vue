<template>
    <div>
    <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Building Type</h1>
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
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Description</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Delivery Form</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="item in data.data" :key="item.id">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-center font-medium text-gray-900 sm:pl-6">{{ item.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ item.description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ item.delivery_form == true ? 'Active' : 'Inactive'  }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ item.status == true ? 'Active' : 'Inactive' }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6">
                                        <a @click.prevent="editBuilding(item)" href="#" class="text-cyan-600 hover:text-cyan-900">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Building Type'" :description="'A roster of all building types associated with your account, including their category, description and location.'">
            <template v-slot:slider-body>
                <form @submit.prevent="editMode ? updateBuilding() : saveBuilding()">
                    <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                        <div class="my-4 grid grid-cols-1">
                            <div class="sm:col-span-3">
                                <label for="building-name" class="block text-sm font-medium leading-6 text-gray-900">Building Name</label>
                                <div class="mt-2">
                                    <input v-model="form.name" type="text" name="building-name" id="building-name" autocomplete="given-name" class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                            <div class="sm:col-span-3 mt-3">
                                <label for="building-name" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                    <input v-model="form.description" type="text" name="building-name" id="building-name" autocomplete="given-name" class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>
                            <div class="sm:col-span-3 mt-5">
                                <Toogle v-model="form.delivery_form" title="Add Delivery Registration" :hasDescription="false" ></Toogle>
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
  name:"BuildingTypeTable",
  props: {
    data:{
        type:Array,
        default: {}
    }
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
            delivery_form: true,
            status:true,
        }),
    }
  },
  methods:{
    setOpen(){
        this.editMode = false;
        this.open = !this.open
    },
    saveBuilding(){
        this.$Progress.start();
        this.form.post('/api/building-types')
        .then((data) => {
            this.$Progress.finish();
            createToast({
                title: 'Success!',
                description: 'Data has been saved.'
                },
                {
                position: 'top-left',
                showIcon: 'true',
                type: 'success',
                hideProgressBar: 'true',
            })
            this.getData();
            this.form.reset();

        }).catch((error) => {
            this.$Progress.fail();
        })
    },
    editBuilding(item){
        this.editMode = true;
        this.open = !this.open
        this.form = item
    },
    updateBuilding(){
        axios.put("/api/building-types/"+ this.form.id, {
            params:{
                data: this.form
            }
        }).then((data) =>{
            this.editMode = false
            this.$Progress.finish();
            createToast({
                title: 'Success!',
                description: 'Data has been updated.'
                },
                {
                position: 'top-left',
                showIcon: 'true',
                type: 'success',
                hideProgressBar: 'true',
            })
            this.getData();
            this.form.reset();
        }).catch((error) => {

        })
    },
   async getData(){
        await axios.get('/api/building-types').then((data) =>{
            this.data = data.data.data;
        }).catch((e) => {
            errorMessage('Opps!', e.message, 'top-right')
        });
    }
  },
  created(){
    this.getData();
  }
    
    
}

</script>