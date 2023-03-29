<template>
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select Tab</label>
            <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option v-for="item in tabs" :key="item.name">{{item.name}}</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li class="w-full" v-for="(item,index) in tabs" :key="item.name">
                <a href="#" @click.prevent="setTab(item.name)" :class="[index == 0 ? 'rounded-l-lg' : (tabs.length - 1 == index ? 'rounded-r-lg' : '') , currentTab == item.name ? 'active dark:bg-cyan-800' : 'dark:bg-cyan-700' ,'inline-block w-full p-4 text-gray-900 bg-cyan-500 focus:ring-4 focus:ring-blue-500 focus:outline-none  dark:text-white']" aria-current="page">
                    {{ item.name }}
                </a>
            </li>
        </ul>
    </div>
    <div v-show="currentTab == 'Building Type'" class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4" >
        <BuildingTypeTable :data="building_types"></BuildingTypeTable>
    </div>
    <div v-show="currentTab == 'Email Template'"  class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4" >
        <EmailTemplateTable :data="email_templates"></EmailTemplateTable>
    </div>
    <div v-show="currentTab == 'SMS Template'"  class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4" >
        <SMSTemplateTable :data="sms_templates"></SMSTemplateTable>
    </div>
</template>

<script>
import axios from "axios";
import BuildingTypeTable from '@/components/Elements/Settings/BuildingTypeTable.vue'
import SMSTemplateTable from '@/components/Elements/Settings/SMSTemplateTable.vue'
import EmailTemplateTable from '@/components/Elements/Settings/EmailTemplateTable.vue'

export default{
  data () {
    return {
        currentTab:'Building Type',
        tabs:[
            {name: 'Building Type', description:'A roster of all building types associated with your account, including their category, description and location.'},
            {name: 'Email Template', description:'A catalog of all email template maintenance entries'},
            {name: 'SMS Template', description:'A catalog of all sms template maintenance entries'}
        ],
        building_types:{},
        email_templates:{},
        sms_templates:{},
    }
  },
  components:{
    BuildingTypeTable, SMSTemplateTable, EmailTemplateTable
  },    
  methods: {
  async setTab(name){
        this.currentTab = name
        switch(name){
            case 'Building Type':
                await axios.get('/api/building-types').then((data) =>{
                    this.building_types = data.data.data;
                }).catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
            break;

            case 'Email Template':
                await axios.get('/api/email-template').then((data) =>{
                    this.email_templates = data.data.data;
                }).catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
            break;

            case 'SMS Template':
                await axios.get('/api/sms-template').then((data) =>{
                    this.sms_templates = data.data.data;
                }).catch((e) => {
                    errorMessage('Opps!', e.message, 'top-right')
                });
            break;

            default:
                await axios.get('/api/building-types').then((data) =>{
                        this.building_types = data.data.data;
                    }).catch((e) => {
                        errorMessage('Opps!', e.message, 'top-right')
                    });
                break;

        }
    }
  },
  watch: {

  },
  props: {

  },
  created () {
     axios.get('/api/building-types').then((data) =>{
                        this.building_types = data.data.data;
                    }).catch((e) => {
                        errorMessage('Opps!', e.message, 'top-right')
                    });

  },

}

</script>