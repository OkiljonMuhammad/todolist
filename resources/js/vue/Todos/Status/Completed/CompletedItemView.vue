<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <completed-item
       v-if="item.status === 'completed'"
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
  </div>
  </div>
</template>
  
  <script>
  import { mapState, mapActions } from 'vuex';
  import CompletedItem from './CompletedItem.vue';
  
  export default {
    components: {
    CompletedItem
    },
    computed: {
      ...mapState(['items'])
    },
    methods: {
      ...mapActions(['fetchItems'])
    },
    created() {
      this.fetchItems();
    }
  };
  </script>
  