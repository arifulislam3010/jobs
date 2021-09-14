// import Vue from 'vue'
// import '@progress/kendo-ui';
// import '@progress/kendo-theme-default/dist/all.css';
// import { Editor, EditorTool, EditorInstaller } from '@progress/kendo-editor-vue-wrapper';
// Vue.use(EditorInstaller)
// Vue.component('Editor', Editor)

import Vue from 'vue'
// import Vuex from 'vuex'
// import Vueditor from 'vueditor'

// import 'vueditor/dist/style/vueditor.min.css'

// // your config here
// let config = {
//     toolbar: [
//         'removeFormat', 'undo', '|', 'elements', 'fontName', 'fontSize', 'foreColor', 'backColor', 'divider',
//         'bold', 'italic', 'underline', 'strikeThrough', 'links', 'divider', 'subscript', 'superscript',
//         'divider', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 'indent', 'outdent',
//         'insertOrderedList', 'insertUnorderedList', '|', 'picture', 'tables', '|', 'switchView','|','sourceCode'
//       ],
//       fontName: [
//         {val: 'arial black'}, 
//         {val: 'times new roman'}, 
//         {val: 'Courier New'}
//       ],
//       fontSize: [
//         '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px'
//       ],
//       uploadUrl: ''
// };

// Vue.use(Vuex);
// Vue.use(Vueditor, config);

import CKEditor from 'ckeditor4-vue';

// Vue.component('Editor', Editor)
// CKEditor.config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre;address;div';

Vue.component('ckeditor', CKEditor.component)
