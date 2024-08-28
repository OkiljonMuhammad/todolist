<template>
  <div class="todoListContainer">
    <div class="heading">
      <h1 id="title">{{ $t('todoList') }}</h1>
      <locale-switcher />
      <add-item-form v-on:reloadList="getList()" />
    </div>
    <list-view :items="items" v-on:reloadList="getList()" />
  </div>
</template>

<script>
import axios from 'axios'; 
import ListView from './ListView.vue';
import AddItemForm from './AddItemForm.vue'; 
import LocaleSwitcher from './LocaleSwitcher.vue';

export default {
  components: {
    ListView,
    AddItemForm,
    LocaleSwitcher
  },
  data() {
    return {
      items: [], 
    };
  },
  methods: {
    getList() {
      axios
        .get('/api/items')
        .then(response => {
          this.items = response.data; 
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  created() {
    this.getList(); 
  },
};
</script>

<style scoped>
.todoListContainer {
  width: 350px;
  margin: auto;
}

.heading {
  background: #e6e6e6;
  padding: 10px;
}

#title {
  text-align: center;
}
</style>
