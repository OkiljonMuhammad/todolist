<template>
  <div>
    <button @click="changeLocale('en')">English</button>
    <button @click="changeLocale('uz')">Uzbek</button>
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

<style scoped>

button {
  margin: 5px;
}
</style>
