import './bootstrap';
import { createApp } from 'vue';
import App from './vue/app.vue';
import router from './config/router.js'
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
import { faCirclePlus, faFileCirclePlus, faPenToSquare, faTrash, faMoon, faSun } from '@fortawesome/free-solid-svg-icons'
library.add(faCirclePlus, faFileCirclePlus, faPenToSquare, faTrash, faMoon, faSun)

const app = createApp(App);

app.component('VForm', Form);
app.component('VField', Field);
app.component('ErrorMessage', ErrorMessage);

defineRule('required', value => !!value || i18n.global.t('required'));
defineRule('email', value => {
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pattern.test(value) || i18n.global.t('invalid_email');
});
configure({
  validateOnInput: true, 
});
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.use(store);
app.use(i18n);
app.use(vuetify);
app.config.globalProperties.$lodash = _;
app.config.globalProperties.$moment = moment;
app.mount('#app');
