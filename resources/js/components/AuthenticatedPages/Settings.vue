<template>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 mt-3">
        <div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select Tab</label>
                <select id="tabs"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option v-for="item in tabs" :key="item.name" @click.prevent="setTab(item.name)">{{ item.name }}
                    </option>
                </select>
            </div>
            <ul
                class="hidden text-sm font-medium text-center text-gray-500 rounded-lg sm:flex dark:text-gray-400">
                <li class="w-full" v-for="(item, index) in tabs" :key="item.name">
                    <a href="#" @click.prevent="setTab(item.name)"
                        :class="[index == 0 ? 'rounded-l-lg' : (tabs.length - 1 == index ? 'rounded-r-lg' : ''), currentTab == item.name ? 'bg-blue-800 text-white ' : 'text-black', 'inline-block w-full p-4 focus:outline-none border border-gray-300']"
                        aria-current="page">
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </div>
        <div v-show="currentTab == 'Building Type'"
            class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <BuildingTypeTable :data="building_types"></BuildingTypeTable>
        </div>
        <div v-show="currentTab == 'Email Template'"
            class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <EmailTemplateTable :data="email_templates"></EmailTemplateTable>
        </div>
        <div v-show="currentTab == 'SMS Template'"
            class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <SMSTemplateTable :data="sms_templates"></SMSTemplateTable>
        </div>
        <div v-show="currentTab == 'Visit Types'"
            class="p-5 sm:px-6 lg:px-8 bg-white rounded-lg ring-1 ring-slate-900/10 mt-4">
            <VisitTypeTable :data="visit_type"></VisitTypeTable>
        </div>
        
    </div>
</template>

<script>
import axios from "axios";
import { userAuthStore } from "@/store/auth";
import BuildingTypeTable from '@/components/Elements/Settings/BuildingTypeTable.vue'
import SMSTemplateTable from '@/components/Elements/Settings/SMSTemplateTable.vue'
import EmailTemplateTable from '@/components/Elements/Settings/EmailTemplateTable.vue'
import VisitTypeTable from '@/components/Elements/Settings/VisitTypeTable.vue'

export default {
    data() {
        return {
            currentTab: 'Building Type',
            tabs: [
                { name: 'Building Type', description: 'A roster of all building types associated with your account, including their category, description and location.' },
                { name: 'Email Template', description: 'A catalog of all email template maintenance entries' },
                { name: 'SMS Template', description: 'A catalog of all sms template maintenance entries' },
                { name: 'Visit Types', description: 'List of all User Visit Types' }
            ],
            building_types: {},
            email_templates: {},
            sms_templates: {},
            visit_type: {},
            permissions: {}

        }
    },
    components: {
        BuildingTypeTable, SMSTemplateTable, EmailTemplateTable, VisitTypeTable
    },
    methods: {
        async setTab(name) {
            this.currentTab = name
            switch (name) {
                case 'Building Type':
                    await axios.get('/api/building-types').then((data) => {
                        this.building_types = data.data.data;
                    }).catch((e) => {
                        // errorMessage('Opps!', e.message, 'top-right')
                    });
                    break;

                case 'Email Template':
                    await axios.get('/api/email-template').then((data) => {
                        this.email_templates = data.data.data;
                    }).catch((e) => {
                        //  errorMessage('Opps!', e.message, 'top-right')
                    });
                    break;

                case 'SMS Template':
                    await axios.get('/api/sms-template').then((data) => {
                        this.sms_templates = data.data.data;
                    }).catch((e) => {
                        //errorMessage('Opps!', e.message, 'top-right')
                    });
                    break;

                case 'Visit Types':
                    await axios.get('/api/visit-type').then((data) => {
                        this.visit_type = data.data.data;
                    }).catch((e) => {
                        //errorMessage('Opps!', e.message, 'top-right')
                    });
                    break;

                default:
                    await axios.get('/api/building-types').then((data) => {
                        this.building_types = data.data.data;
                    }).catch((e) => {
                        //  errorMessage('Opps!', e.message, 'top-right')
                    });
                    break;

            }
        }
    },
    created() {
        axios.get('/api/building-types').then((data) => {
            this.building_types = data.data.data;
        }).catch((e) => {
            // errorMessage('Opps!', e.message, 'top-right')
        });
        
    },
    beforeMount() {
        this.permissions = {
            view: userAuthStore().role.permissions.visitors.includes('view') ?? false,
            create: userAuthStore().role.permissions.visitors.includes('create') ?? false,
            update: userAuthStore().role.permissions.visitors.includes('update') ?? false
        }
    }

}

</script>