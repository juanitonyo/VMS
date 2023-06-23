<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-extrabold leading-6 text-gray-900">Email Template Table</h1>
            <p class="mt-2 text-xs text-gray-600">A catalog of all email template maintenance entries.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button @click.prevent="setOpen" type="button"
                class="block rounded-md bg-gray-900 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Compose
                Email</button>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-auto shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Purpose
                                </th>
                                <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">Subject
                                </th>
                                <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">Body</th>
                                <th scope="col" class="text-left px-3 py-3.5 text-sm font-semibold text-gray-900">
                                    Description</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in data.data" :key="item.id">
                                <td class=" py-4 pl-4 pr-3 text-center text-xs font-bold text-gray-900 sm:pl-6">{{ item.id
                                }}</td>
                                <td class=" px-3 py-4 text-xs text-left w-40 text-gray-500">{{ item.purpose }}</td>
                                <td class=" px-3 py-4 text-xs text-left w-56 text-gray-500">{{ item.subject }}</td>
                                <td
                                    class=" px-3 py-4 text-xs text-left whitespace-nowrap  text-indigo-400  hover:text-indigo-900">
                                    <a @click.prevent="isOpen(item)" href="">[ View Content ]</a>
                                </td>
                                <td class=" px-3 py-4 w-80 break-all text-xs text-left text-gray-500">{{ item.description }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-xs text-center text-gray-500 ">{{ item.status ==
                                    true ? 'Active' : 'Inactive' }}</td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-xs font-medium sm:pr-6">
                                    <a @click.prevent="editTemplate(item)" href="#"
                                        class="flex justify-center text-slate-800 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                d="M7.84 1.804A1 1 0 018.82 1h2.36a1 1 0 01.98.804l.331 1.652a6.993 6.993 0 011.929 1.115l1.598-.54a1 1 0 011.186.447l1.18 2.044a1 1 0 01-.205 1.251l-1.267 1.113a7.047 7.047 0 010 2.228l1.267 1.113a1 1 0 01.206 1.25l-1.18 2.045a1 1 0 01-1.187.447l-1.598-.54a6.993 6.993 0 01-1.929 1.115l-.33 1.652a1 1 0 01-.98.804H8.82a1 1 0 01-.98-.804l-.331-1.652a6.993 6.993 0 01-1.929-1.115l-1.598.54a1 1 0 01-1.186-.447l-1.18-2.044a1 1 0 01.205-1.251l1.267-1.114a7.05 7.05 0 010-2.227L1.821 7.773a1 1 0 01-.206-1.25l1.18-2.045a1 1 0 011.187-.447l1.598.54A6.993 6.993 0 017.51 3.456l.33-1.652zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                clip-rule="evenodd" />
                                        </svg>

                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-end mt-3">
                    <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true"/>
                </div>
            </div>
        </div>
    </div>

    <SliderVue :setOpen="open" :title="(editMode ? 'Update ' : 'Add ') + 'Email Template'"
        :description="'A catalog of all email template maintenance entries.'">
        <template v-slot:slider-body>
            <form @submit.prevent="editMode ? updateTemplate() : saveTemplate()">
                <div class="relative flex-1 py-2 px-4 sm:px-6 divide-y divide-gray-200 border ">
                    <div class="my-4 grid grid-cols-1">

                        <div class="sliderPurpose sm:col-span-3 mt-3 text-sm">
                            <div class="flex justify-between">
                                <label for="email_subj"
                                    class="block text-sm font-medium leading-6 text-gray-900">Choose
                                    Purpose</label>
                                <span v-show="this.editMode ? false : form.errors.has('purpose')"
                                    class="text-[10px] text-red-600 dark:text-red-500">{{ forMessage() }}</span>
                            </div>
                            <v-select v-model="form.purpose" placeholder="Search" :options="option" label="label"
                                :class="this.editMode ? '' : forClass()"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.subject" label="Subject" id="email_subj"
                                :hasError="this.editMode ? false : form.errors.has('subject')"
                                :errorMessage="this.editMode ? false : form.errors.get('subject')"></NormalInput>
                        </div>

                        <div class="editor sm:col-span-3 mt-3">
                            <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                            <div>
                                <ckeditor v-model="form.body" :editor="editor" :config="editorConfig"></ckeditor>
                            </div>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="email_subj"
                                :hasError="this.editMode ? false : form.errors.has('description')"
                                :errorMessage="this.editMode ? false : form.errors.get('description')"></NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status"
                                    :class="[form.status ? 'bg-gray-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
                                    <span aria-hidden="true"
                                        :class="[form.status ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                </Switch>
                            </SwitchGroup>
                        </div>
                    </div>
                </div>
                <div class="flex flex-shrink-0 justify-end px-4 py-4 ">
                    <button type="button"
                        class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                        @click="setOpen">Cancel</button>
                    <button type="submit"
                        class="ml-4 inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">{{
                            editMode
                            ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </template>
    </SliderVue>

    <DialogVue :isOpen="pop" :dialogTitle="'Body Content'">
        <template v-slot:dialogBody>
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg p-5 my-5">
                <p v-html="form.body"></p>
            </div>
            <div class="mt-4">
                <button type="button"
                    class="inline-flex justify-center rounded-md bg-gray-900 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500"
                    @click.prevent="isOpen">
                    Close
                </button>
            </div>
        </template>
    </DialogVue>
</template>

<script>

import axios from "axios";
import Form from "vform";
import SliderVue from '@/components/Elements/Modals/Slider.vue'
import DialogVue from '@/components/Elements/Modals/Dialog.vue'
import { createToast } from 'mosha-vue-toastify'
import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import NormalInput from "../Inputs/NormalInput.vue";
import VueMultiselect from 'vue-multiselect';

export default {

    name: "EmailTemplateTable",
    props: {
        data: {
            type: Array,
            default: {},
        }
    },
    components: {
        DialogVue, SliderVue, Switch, SwitchDescription, SwitchGroup, SwitchLabel, NormalInput, VueMultiselect,
    },
    data() {
        return {
            data: {},
            editMode: false,
            open: false,
            pop: false,
            form: new Form({
                id: '',
                purpose: '',
                subject: '',
                body: '',
                description: '',
                status: false,
            }),

            editor: ClassicEditor,
            editorConfig: {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', '|', 'link', 'heading', 'sourceediting'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                }
            },

            placeholder: 'Choose a purpose: ',

            option: [
                { label: 'Register', value: 'register' }, 
                { label: 'Reset Password', value: 'reset-password' }, 
                { label: 'Invitation', value: 'invitation' }, 
                { label: 'Check-In', value: 'checkin' }
            ],
        }
    },
    methods: {
        setOpen() {
            this.editMode = false;
            this.open = !this.open;
            this.form = new Form({
                id: '',
                purpose: '',
                subject: '',
                body: '',
                description: '',
                status: false,
            })
        },
        isOpen(item) {
            this.form = item;
            this.pop = !this.pop;
        },
        saveTemplate() {
            this.form.purpose = this.form.purpose.value;
            this.$Progress.start();
            this.form.post('/api/email-template')
                .then((data) => {
                    this.$Progress.finish();
                    this.getData();
                    this.form = new Form({
                        id: '',
                        purpose: '',
                        subject: '',
                        body: '',
                        description: '',
                        status: true,
                    });
                    this.open = !this.open;
                    createToast({
                        title: 'Success!',
                        description: 'Data has been saved.'
                    },
                        {
                            position: 'top-left',
                            showIcon: 'true',
                            type: 'success',
                            toastBackgroundColor: '#00bcd4',
                            hideProgressBar: 'true',
                            toastBackgroundColor: '#00bcd4',
                        })
                }).catch((error) => {
                    this.$Progress.fail();
                })
        },
        updateTemplate() {
            axios.put("/api/email-template/" + this.form.id, {
                params: {
                    data: this.form
                }
            }).then((data) => {
                this.editMode = false;
                this.$Progress.finish();
                this.open = !this.open;
                this.getData();
                this.form = new Form({})
                createToast({
                    title: 'Success!',
                    description: 'Data has been updated.'
                },
                    {
                        position: 'top-left',
                        showIcon: 'true',
                        type: 'success',
                        toastBackgroundColor: '#00bcd4',
                        hideProgressBar: 'true',
                        toastBackgroundColor: '#00bcd4',
                    })
            }).catch((error) => {

            })
        },
        editTemplate(item) {
            this.editMode = true;
            this.open = !this.open;
            this.form = item;
        },
        async getData(page = 1) {
            await axios.get('/api/email-template?page=' + page).then((data) => {
                this.data = data.data.data;
            }).catch((e) => {
                // errorMessage('Opps!', e.message, 'top-right')
            });
        },
        forClass() {
            return this.form.errors.has('purpose') ? 'bg-red-50 border rounded-md border-red-500 text-red-900 placeholder-red-700' : ''
        },
        forMessage() {
            return this.editMode ? ' ' : this.form.errors.get('purpose')
        }
    },
    created() {
        this.getData();
    }

}

</script>