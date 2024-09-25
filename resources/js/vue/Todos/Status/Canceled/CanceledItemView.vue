<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
      <canceled-item
       v-if="item.status === 'canceled'"
        :item="item"
        class="items"
        v-on:itemChanged="fetchItems"
      />
  </div>
  </div>
</template>
  
  <script>
  import { mapState, mapActions } from 'vuex';
  import CanceledItem from './CanceledItem.vue';
  
  export default {
    components: {
      CanceledItem
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
  