<template>
  <div class="todoListContainer">
    <div class="heading">
      <locale-switcher id="lan"/>
      <h1 id="title">{{ $t('todoList') }}</h1>
      <add-item-form v-on:reloadList="fetchItems" />
    </div>
    <list-view v-on:reloadList="fetchItems" />
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import ListView from './ListView.vue';
import AddItemForm from './AddItemForm.vue'; 
import LocaleSwitcher from './LocaleSwitcher.vue';

export default {
  components: {
    ListView,
    AddItemForm,
    LocaleSwitcher
  },
  methods: {
    ...mapActions(['fetchItems'])
  },
  created() {
    this.fetchItems();
  }
};
</script>

