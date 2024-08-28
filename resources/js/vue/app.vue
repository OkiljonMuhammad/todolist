<template>
  <div class="todoListContainer">
    <div class="heading">
      <h1 id="title">Todo List</h1>
      <add-item-form @reloadList="fetchItems" />
      <!--<list-item/> -->
    </div>
    <list-view :items="items" @reloadList="fetchItems" />
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ListView from './ListView.vue';
import AddItemForm from './AddItemForm.vue';

export default {
  components: {
    ListView,
    AddItemForm,
  },
  name: 'App',
  computed: {
    ...mapState(['items'])
  },
  methods: {
    ...mapActions(['fetchItems']),
  },
  created() {
    this.fetchItems();
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
