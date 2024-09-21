<template>
  <div id="app" :class="{ 'dark-mode': isDarkMode }">
     <locale-switcher class="lan"/>
    <button class="dark-mode-button" @click="$store.commit('toggleDarkMode')">
      <font-awesome-icon :icon="$store.state.isDarkMode ? 'sun' : 'moon'" />
      {{ $store.state.isDarkMode ? 'Light' : 'Dark' }}
    </button>
    
    <router-view />
  </div>
</template>

<script>
import LocaleSwitcher from './Language/LocaleSwitcher.vue';
import { mapState, mapMutations } from 'vuex';

export default {
  computed: {
    ...mapState({
      isDarkMode: state => state.isDarkMode
    })
  },
  methods: {
    ...mapMutations({
      toggleDarkMode: 'toggleDarkMode'
    })
  },
  created() {
    this.$store.dispatch('initDarkMode');
  },
  components: {
    LocaleSwitcher,
  }
};
</script>


