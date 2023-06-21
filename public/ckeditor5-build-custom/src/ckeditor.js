/**
 * @license Copyright (c) 2014-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor.js';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment.js';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold.js';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials.js';
import FontSize from '@ckeditor/ckeditor5-font/src/fontsize.js';
import GeneralHtmlSupport from '@ckeditor/ckeditor5-html-support/src/generalhtmlsupport.js';
import Heading from '@ckeditor/ckeditor5-heading/src/heading.js';
import Markdown from '@ckeditor/ckeditor5-markdown-gfm/src/markdown.js';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph.js';
import SourceEditing from '@ckeditor/ckeditor5-source-editing/src/sourceediting.js';

class Editor extends ClassicEditor {}

// Plugins to include in the build.
Editor.builtinPlugins = [
	Alignment,
	Bold,
	Essentials,
	FontSize,
	GeneralHtmlSupport,
	Heading,
	Markdown,
	Paragraph,
	SourceEditing
];

// Editor configuration.
Editor.defaultConfig = {
	toolbar: {
		items: [
			'heading',
			'|',
			'bold',
			'|',
			'undo',
			'redo'
		]
	},
	language: 'en'
};

export default Editor;
