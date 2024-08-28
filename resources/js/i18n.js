import { createI18n } from 'vue-i18n';


import en from './locales/en.json';
import uz from './locales/uz.json'; 

const i18n = createI18n({
  locale: 'en', 
  fallbackLocale: 'en', 
  messages: {
    en,
    uz,
  }
});

export default i18n;
