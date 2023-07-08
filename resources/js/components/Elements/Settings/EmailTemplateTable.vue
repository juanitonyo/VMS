<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-extrabold leading-6 text-blue-800">Email Template Table</h1>
            <p class="mt-2 text-xs text-gray-600">A catalog of all email template maintenance entries.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex gap-1">
            <button @click.prevent="setOpen" type="button"
                class="block rounded-md bg-blue-800 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-800/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Compose
                Email</button>
            <!-- <button class="bg-blue-800 p-2 rounded-md hover:bg-blue-800/90">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                        clip-rule="evenodd" />
                </svg>
            </button> -->
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>

                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-end mt-3">
                    <TailwindPagination :data="data" @pagination-change-page="getData" :limit="1" :keepLength="true" />
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
                                <label for="email_subj" class="block text-sm font-medium leading-6 text-gray-900">Choose
                                    Purpose</label>
                                <span class="text-[10px] text-red-600 dark:text-red-500"
                                    v-show="form.errors && (form.errors.has('purpose') ?? false)"
                                    v-html="form.errors && (form.errors.has('purpose')) ? form.errors.get('purpose') : ''"></span>
                            </div>
                            <v-select v-model="form.purpose" placeholder="Search" :options="option"
                                label="label"
                                :class="form.errors && (form.errors.has('purpose') ?? false) ? 'bg-red-50 border border-red-400 rounded-md text-red-900 placeholder-red-700' : ''"></v-select>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.subject" label="Subject" id="email_subj"
                                :hasError="form.errors && (form.errors.has('subject') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('subject') ?? false) ? form.errors.get('subject') : ''">
                            </NormalInput>
                        </div>

                        <div class="editor sm:col-span-3 mt-3">
                            <div class="flex justify-between">
                                <label for="email_subj"
                                    class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                                <span class="text-[10px] text-red-600 dark:text-red-500 mt-1"
                                    v-show="form.errors && (form.errors.has('body') ?? false)"
                                    v-html="form.errors && (form.errors.has('body')) ? form.errors.get('body') : ''"></span>
                            </div>
                            <div>
                                <ckeditor
                                    :class="form.errors && (form.errors.has('body') ?? false) ? 'border border-red-400 rounded-md bg-red-700' : ''"
                                    v-model="form.body" :editor="editor" :config="editorConfig"></ckeditor>
                            </div>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <NormalInput v-model="form.description" label="Description" id="email_subj"
                                :hasError="form.errors && (form.errors.has('description') ?? false)"
                                :errorMessage="form.errors && (form.errors.has('description') ?? false) ? form.errors.get('description') : ''">
                            </NormalInput>
                        </div>

                        <div class="sm:col-span-3 mt-3">
                            <SwitchGroup as="div" class="flex items-center justify-between">
                                <span class="flex flex-grow flex-col">
                                    <SwitchLabel as="span" class="text-sm font-medium leading-6 text-gray-900" passive>
                                        Status</SwitchLabel>
                                </span>
                                <Switch v-model="form.status"
                                    :class="[form.status ? 'bg-blue-800' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2']">
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

import { ClassicEditor } from '@ckeditor/ckeditor5-editor-classic';
import { Essentials } from '@ckeditor/ckeditor5-essentials';
import { Bold, Italic } from '@ckeditor/ckeditor5-basic-styles';
import { Link } from '@ckeditor/ckeditor5-link';
import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
import { SourceEditing } from '@ckeditor/ckeditor5-source-editing';
// import { Table, TableToolbar } from '@ckeditor/ckeditor5-table';
import { GeneralHtmlSupport } from '@ckeditor/ckeditor5-html-support';

import NormalInput from "../Inputs/NormalInput.vue";

export default {

    name: "EmailTemplateTable",
    props: {
        data: {
            type: Array,
            default: {},
        }
    },
    components: {
        DialogVue, SliderVue, Switch, SwitchDescription, SwitchGroup, SwitchLabel, NormalInput
    },
    data() {
        return {
            data: [],
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
                plugins: [
                    Essentials,
                    Bold,
                    Italic,
                    Link,
                    Paragraph,
                    SourceEditing,
                    // Table,
                    // TableToolbar,
                    GeneralHtmlSupport
                ],

                toolbar: {
                    items: [
                        'bold',
                        'italic',
                        'link',
                        'undo',
                        'redo',
                        'sourceEditing',
                        // 'insertTable'
                    ]
                },
                table: {
                    defaultHeadings: { rows: 1, columns: 1 }
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
    },
    created() {
        this.getData();
    }

}

</script>