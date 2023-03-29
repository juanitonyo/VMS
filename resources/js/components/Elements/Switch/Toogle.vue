<template>
    <SwitchGroup as="div" class="flex items-center justify-between">
      <span class="flex flex-grow flex-col">
        <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>{{ title }}</SwitchLabel>
        <SwitchDescription v-show="hasDescription" as="span" class="text-sm text-gray-500">{{ description }}</SwitchDescription>
      </span>
      <Switch @click="toggleSwitch" v-model="enabled" :class="[enabled ? 'bg-cyan-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2']">
        <span aria-hidden="true" :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
      </Switch>
    </SwitchGroup>
</template>
  

<script>
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
    export default{
        name:'Toogle',
        components:{
            Switch, SwitchDescription, SwitchGroup, SwitchLabel
        },
        props:{
            title:{
                type:String,
                default: 'Title'
            },
            description:{
                type: String,
                default: 'Description',
            },
            hasDescription:{
                type: Boolean,
                default: false,
            }
        },
        data(){
            return {
                enabled: false,
            }
        },
        methods:{
            toggleSwitch() {
            this.isActive = !this.isActive;
            this.$emit('switchToggled', this.isActive);
        }}
    }

</script>