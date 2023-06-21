<template>
    <div class="min-h-screen min-w-full flex items-center justify-center">
        <div>
            <ckeditor :editor="editor" :config="editorConfig"></ckeditor>
        </div>
    </div>
</template>

<script>

// import { SourceEditing } from '@ckeditor/ckeditor5-source-editing';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    name: 'BasicExampleURL',

    components: {
    },

    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                toolbar: ['undo', 'redo', '|', 'bold', 'italic', '|', 'link', 'heading', '|', 'sourceEditing'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
            },
        }
    },
}
</script>