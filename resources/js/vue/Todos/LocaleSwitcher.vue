<template>
  <div>
    <button class="enbutton" @click="changeLocale('en')"></button>
    <button class="uzbutton" @click="changeLocale('uz')"></button>
  </div>
</template>

<script>
import { useI18n } from 'vue-i18n';

export default {
  setup() {
    const { locale } = useI18n();

    function changeLocale(lang) {
      locale.value = lang;
    }

    return { changeLocale };
  }
};
</script>
