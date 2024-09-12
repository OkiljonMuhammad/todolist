import './bootstrap';
import { createApp } from 'vue';
import App from './vue/app.vue';
import addItemForm from './vue/AddItemForm.vue';
import ListItem from './vue/ListItem.vue';
import ListView from './vue/ListView.vue';
import UploadExcelFile from './vue/UploadExcelFile.vue';
import ExportExcelFile from './vue/ExportExcelFile.vue';
import store from './store/index.js';
import i18n from './i18n'; 
import './scss/styles.scss';
import vuetify from './plugins/vuetify';
import _ from 'lodash';
import moment from 'moment';
import { defineRule, configure, Field, Form, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCirclePlus, faFileCirclePlus, faPenToSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import '@mdi/font/css/materialdesignicons.css';

library.add(faCirclePlus, faFileCirclePlus, faPenToSquare, faTrash)

const app = createApp(App);

app.component('add-item-form', addItemForm);
app.component('list-item', ListItem);
app.component('list-view', ListView);
app.component('upload-excel-file', UploadExcelFile);
app.component('export-excel-file', ExportExcelFile);
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(store);
app.use(i18n);
app.use(vuetify);
app.config.globalProperties.$lodash = _;
app.config.globalProperties.$moment = moment;
app.mount('#app');
